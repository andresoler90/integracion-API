<?php namespace App\Http\Core;

use App\Models\MiProveedor\Loc3Country;
use App\Models\MiProveedor\Paym1_providerPayments;
use App\Models\MiProveedor\Pv15_statesRelations;
use App\Models\MiProveedor\Pv1_providers;
use App\Models\MiProveedor\Use6Currencies;
use App\Payment\Paym1Product;
use App\Payment\Paym2SubProduct;
use App\Payment\Paym3TypeBase;
use App\Payment\Paym4Client;
use App\Payment\Paym5Relation;
use App\Payment\Paym6PaymentRegister;
use App\Payment\Paym7ClientCountry;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\Session;
use stdClass;

class ManagementPayment
{
    private $paymProducts;
    private $paymSubProducts;
    private $paymTypeBases;
    private $paymClients;
    private $paymRelations;
    private $paymPaymentRegisters;
    private $paymClientCountries;

    public function __construct()
    {
        $this->paymProducts = new Paym1Product();
        $this->paymSubProducts = new Paym2SubProduct();
        $this->paymTypeBases = new Paym3TypeBase();
        $this->paymClients = new Paym4Client();
        $this->paymRelations = new Paym5Relation();
        $this->paymPaymentRegisters = new Paym6PaymentRegister();
        $this->paymClientCountries = new Paym7ClientCountry();
    }


    /**
     * @date: 16/03/21
     * @sum: Objeto vacio simulacion de entidad
     * @return stdClass
     */
    public function startObject()
    {
        $objectClass = new stdClass();
        $objectClass->paym1_id = null;
        $objectClass->paym2_id = null;
        $objectClass->paym3_id = null;
        $objectClass->paym4_id = null;
        $objectClass->paym5_id = null;
        $objectClass->paym6_id = null;
        $objectClass->paym5_value = null;
        $objectClass->loc3_id = null;
        $objectClass->use6_id =null;
        return $objectClass;
    }


    /**
     * @date: 16/03/21
     * @sum: Objeto cargado de consumo
     * @return stdClass
     */
    public function getObject($array = [])
    {
        $objectClass = new stdClass();
        $objectClass->paym1_id = $array["paym1_id"];
        $objectClass->paym2_id = $array["paym2_id"];
        $objectClass->paym3_id = $array["paym3_id"];
        $objectClass->paym4_id = $array["paym4_id"];
        $objectClass->paym5_id = $array["paym5_id"];
        $objectClass->paym6_id = $array["paym6_id"];
        $objectClass->loc3_id = $array["loc3_id"];
        $objectClass->use6_id = $array["use6_id"];
        $objectClass->paym5_value = $array["paym5_value"];
        return $objectClass;
    }

    public function getComposerData($param)
    {
        if($param)
        {
            $countries = Loc3Country::where("loc3_status",1)->get()->pluck("loc3_shortName","loc3_id");
            $countries = Self::PrependSelect($countries);
            $providers = Pv1_providers::where("pv1_status",1)->limit(100)->get()->pluck("pv1_providerName","pv1_id");
            $providers = Self::PrependSelect($providers);
            $data = compact('countries','providers');
            #########################################################################
            return $data;
        }

        $countries = Loc3Country::where("loc3_status",1)->get()->pluck("loc3_shortName","loc3_id");
        $countries = Self::PrependSelect($countries);
        $products = Paym1Product::where("paym1_state",1)->get()->pluck("paym1_product","paym1_id");
        $products = Self::PrependSelect($products);
        $subProducts = Paym2SubProduct::where("paym2_state",1)->get()->pluck("paym2_subProduct","paym2_id");
        $subProducts = Self::PrependSelect($subProducts);
        $bases = Paym3TypeBase::where("paym3_state",1)->get()->pluck("paym3_typeBase","paym3_id");
        $bases = Self::PrependSelect($bases);
        $clients = Paym4Client::where("paym4_state",1)->get()->pluck("paym4_name","paym4_id");
        $clients = Self::PrependSelect($clients);
        $currency = Use6Currencies::where("use6_status",1)->get()->pluck("use6_acronym","use6_id");
        $currency = Self::PrependSelect($currency);
        $data = compact('countries','products',
            'subProducts','bases','clients','currency');
        #########################################################################
        return $data;
    }

    /**
     *
     */
    private static function PrependSelect(\Illuminate\Support\Collection $collection)
    {
        $collection->pull('Seleccione');
        $collection->prepend('Seleccione',0);

        return $collection;
    }

    public function createConfig($camps)
    {
        \DB::beginTransaction();

        try
        {
            $clientCountry = Paym7ClientCountry::where("loc3_id",$camps["loc3_id"])
                ->where("paym4_id",$camps["paym4_id"])->get()->first();

            if(empty($clientCountry) && is_null($clientCountry))
            {
                $model = new Paym7ClientCountry();
                $model->paym4_id = $camps["paym4_id"];
                $model->loc3_id = $camps["loc3_id"];
                $model->save();

                $camps["paym7_id"] = $model->paym7_id;

            }else{
                $camps["paym7_id"] = $clientCountry->paym7_id;
            }

            //Validate the request...
            $model = new Paym5Relation();
            $model->paym5_value = $camps["paym5_value"];
            $model->paym1_id = $camps["paym1_id"];
            $model->paym2_id = $camps["paym2_id"];
            $model->paym3_id = $camps["paym3_id"];
            $model->paym7_id = $camps["paym7_id"];
            $model->use6_id = $camps["use6_id"];
            $model->save();
            \DB::commit();

            return true;

        } catch (\Exception $exception)
        {
            \DB::rollBack();

            if (config('app.debug'))
                dd($exception);

            return false;
        }
    }


    /**
     * @date: 16/03/21
     * @sum: Modificacion de usuario por herencia
     * @return stdClass
     */
    public function updateConfig($camps = [])
    {
        try
        {
            \DB::beginTransaction();
            $model  = new Paym5Relation();

            $clientCountry = Paym7ClientCountry::where("loc3_id",$camps["loc3_id"])
                ->where("paym4_id",$camps["paym4_id"])->get()->first();

            if(empty($clientCountry) && is_null($clientCountry))
            {
                $modelPaym7 = new Paym7ClientCountry();
                $modelPaym7->paym4_id = $camps["paym4_id"];
                $modelPaym7->loc3_id = $camps["loc3_id"];
                $modelPaym7->save();

                $camps["paym7_id"] = $modelPaym7->paym7_id;

            }else{
                $camps["paym7_id"] = $clientCountry->paym7_id;
            }

            unset($camps["_token"]);
            unset($camps["loc3_id"]);
            unset($camps["paym4_id"]);

            $realModel = $model->setPaym5Relations($camps);
            $realModel = $realModel->find($camps["paym5_id"]);
            $flag = $this->saveconfig($realModel,$camps);

            if ($flag)
            {
                \DB::commit();
                return true;
            }

        } catch (\Exception $exception)
        {
            if (config('app.debug'))
                throw new \Exception($exception->getMessage());

            \DB::rollBack();

            return false;
        }

    }

    /**
     * @param array $vlrsChanges
     * @param null $params
     * @return Paym5Relation|bool
     */
    protected function saveConfig(\App\Payment\Paym5Relation $model, $camps)
    {
        foreach ($camps as $column => $newVlr)
            $model->{$column} = $newVlr;

        $flag = $model->save();

        if ($flag)
            return true;
        else
            return false;
    }

    /**
     * @date: 16/03/21
     * @sum: Data para editar
     * @return array
     */
    public function getConfigData($paym5_id = null)
    {
        try
        {
            $model = new Paym5Relation();
            $query = $model->select("paym5_relations.paym5_id","paym5_relations.paym5_value","paym1.paym1_product"
                ,"paym4.paym4_name","loc3.loc3_shortName","paym2.paym2_subProduct","paym3.paym3_typeBase")
                ->join("paym1_products as paym1","paym1.paym1_id","=","paym5_relations.paym1_id")
                ->join("paym2_subproducts as paym2","paym2.paym2_id","=","paym5_relations.paym2_id")
                ->join("paym3_typebases as paym3","paym3.paym3_id","=","paym5_relations.paym3_id")
                ->join("paym7_clientcountries as paym7","paym7.paym7_id","=","paym5_relations.paym7_id")
                ->join("paym4_clients as paym4","paym4.paym4_id","=","paym7.paym4_id")
                ->join("use6_currencies as use6","use6.use6_id","=","paym5_relations.use6_id")
                ->join("loc3_countries as loc3","loc3.loc3_id","=","paym7.loc3_id")
                ->activeRegister()
                ->orderBy('paym4.paym4_name', 'ASC');

            $data = $query->paginate(10);
            return $data;
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());
        }
    }

    /**
     * @sum: Data para editar
     * @return array
     */
    public function getPaymData($paym5_id)
    {
        try
        {
            $model = new Paym5Relation();
            $query = $model->select("paym5_relations.paym5_id","paym5_relations.paym5_value","paym1.paym1_id"
                ,"paym4.paym4_id","loc3.loc3_id","paym2.paym2_id","paym3.paym3_id","use6.use6_id")
                ->join("paym1_products as paym1","paym1.paym1_id","=","paym5_relations.paym1_id")
                ->join("paym2_subproducts as paym2","paym2.paym2_id","=","paym5_relations.paym2_id")
                ->join("paym3_typebases as paym3","paym3.paym3_id","=","paym5_relations.paym3_id")
                ->join("paym7_clientcountries as paym7","paym7.paym7_id","=","paym5_relations.paym7_id")
                ->join("paym4_clients as paym4","paym4.paym4_id","=","paym7.paym4_id")
                ->join("use6_currencies as use6","use6.use6_id","=","paym5_relations.use6_id")
                ->join("loc3_countries as loc3","loc3.loc3_id","=","paym7.loc3_id")
                ->where("paym5_relations.paym5_id",$paym5_id)
                ->activeRegister()
                ->orderBy('paym4.paym4_name', 'ASC');

            $data = $query->get()->first()->toArray();
            return $data;
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $camps
     * @return array
     * @throws \Exception
     */
    public function getCountry($camps)
    {
        try
        {
            $model = new Paym7ClientCountry();
            $query = $model->select("loc3.loc3_id","loc3.loc3_shortName")
                ->join("paym4_clients as paym4","paym4.paym4_id","=","paym7_clientcountries.paym4_id")
                ->join("loc3_countries as loc3","loc3.loc3_id","=","paym7_clientcountries.loc3_id")
                ->where("paym7_clientcountries.paym4_id",$camps["paym4_id"])
                ->where("paym7_clientcountries.paym7_state",1)
                ->orderBy('loc3.loc3_shortName', 'ASC');

            $data = $query->pluck("loc3.loc3_shortName","loc3.loc3_id")->toArray();
            return $data;
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $camps
     * @return array
     * @throws \Exception
     */
    public function getSubProducts($camps)
    {
        try
        {
            $model = new Paym5Relation();
            $query = $model->select("paym2.paym2_id","paym2.paym2_subProduct")
                ->join("paym7_clientcountries as paym7","paym7.paym7_id","=","paym5_relations.paym7_id")
                ->join("paym2_subproducts as paym2","paym2.paym2_id","=","paym5_relations.paym2_id")
                ->where("paym7.paym4_id",$camps["paym4_id"])
                ->where("paym7.loc3_id",$camps["loc3_id"])
                ->where("paym7.paym7_state",1)
                ->where("paym5_state",1)
                ->orderBy('paym2.paym2_subProduct', 'ASC');

            $data = $query->pluck("paym2.paym2_subProduct","paym2.paym2_id")->toArray();
            return $data;
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $camps
     * @return array
     * @throws \Exception
     */
    public function getValue($camps)
    {
        try
        {
            $model = new Paym5Relation();
            $query = $model->select("paym5_value")
                ->join("paym7_clientcountries as paym7","paym7.paym7_id","=","paym5_relations.paym7_id")
                ->where("paym7.paym4_id",$camps["paym4_id"])
                ->where("paym7.loc3_id",$camps["loc3_id"])
                ->where("paym5_relations.paym2_id",$camps["paym2_id"])
                ->where("paym7.paym7_state",1)
                ->where("paym5_state",1);
            $data = $query->get()->first()->paym5_value;
            return $data;
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $camps
     * @return array
     * @throws \Exception
     */
    public function generateSignature($camps)
    {
        try
        {
            //Obtener valor de la transacción
            $model = new Paym5Relation();
            $query = $model->select("paym5_value")
                ->join("paym7_clientcountries as paym7","paym7.paym7_id","=","paym5_relations.paym7_id")
                ->where("paym7.paym4_id",$camps["paym4_id"])
                ->where("paym7.loc3_id",$camps["loc3_id"])
                ->where("paym5_relations.paym2_id",$camps["paym2_id"])
                ->where("paym7.paym7_state",1)
                ->where("paym5_state",1);
            $value = $query->get()->first()->paym5_value;

            //Obtener tipo de moneda de la transacción
            $model = new Paym5Relation();
            $query = $model->select("use6_acronym")
                ->join("paym7_clientcountries as paym7","paym7.paym7_id","=","paym5_relations.paym7_id")
                ->join("use6_currencies as use6","use6.use6_id","=","paym5_relations.use6_id")
                ->where("paym7.paym4_id",$camps["paym4_id"])
                ->where("paym7.loc3_id",$camps["loc3_id"])
                ->where("paym5_relations.paym2_id",$camps["paym2_id"])
                ->where("paym7.paym7_state",1)
                ->where("paym5_state",1);
            $currency = $query->get()->first()->use6_acronym;

            //Obtener nombre del cliente
            $model = new Paym4Client();
            $query = $model->select("paym4_name")
                ->where("paym4_clients.paym4_id",$camps["paym4_id"])
                ->where("paym4_state",1);
            $client = $query->get()->first()->paym4_name;

            //Obtener nombre del pais
            $model = new Loc3Country();
            $query = $model->select("loc3_shortName")
                ->where("loc3_countries.loc3_id",$camps["loc3_id"])
                ->where("loc3_status",1);
            $country = $query->get()->first()->loc3_shortName;

            //Obtener valor del sub producto
            $model = new Paym2SubProduct();
            $query = $model->select("paym2_subProduct")
                ->where("paym2_subproducts.paym2_id",$camps["paym2_id"])
                ->where("paym2_state",1);
            $subProduct = $query->get()->first()->paym2_subProduct;

            $session = new Session();
            $session->set('value', $value);
            $session->set('client', trim($client));
            $session->set('paym4_id', $camps["paym4_id"]);
            $session->set('country', $country);
            $session->set('loc3_id', $camps["loc3_id"]);
            $session->set('subProduct', $subProduct);
            $session->set('paym2_id', $camps["paym2_id"]);
            $session->set('currency', $currency);

            return true;
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());

            return false;
        }
    }

    /**
     * @param $camps
     * @return array|bool
     * @throws \Exception
     */
    public function storeClient($camps)
    {
        try
        {

            $country = Loc3Country::where("loc3_status",1)
                ->where("loc3_id",$camps["paym9_country"])
                ->get()->first()->loc3_shortName;

            $provider = Pv1_providers::where("pv1_status",1)
                ->where("pv1_id",$camps["pv1_id"])
                ->get()->first()->pv1_providerName;

            $session = new Session();
            $session->set('loc3_shortName', $country);
            $session->set('pv1_providerName', $provider);
            $session->set('pv1_id', $camps["pv1_id"]);
            $session->set('paym9_nit', trim($camps["paym9_nit"]));
            $session->set('paym9_fullName', trim($camps["paym9_fullName"]));
            $session->set('paym9_mail', $camps["paym9_mail"]);
            $session->set('paym9_phone', $camps["paym9_phone"]);
            $session->set('paym9_address', $camps["paym9_address"]);
            $session->set('paym9_country', $camps["paym9_country"]);
            return $session->all();
        }
        catch (\Exception $e)
        {
            if (config('app.debug'))
                throw new \Exception($e->getMessage());

            return false;
        }
    }

    /**
     * @param $camps
     * @return array|bool
     * @throws \Exception
     */
    public function madePayment()
    {
        $session = new Session();
        $date = Carbon::now();
        $date = $date->toDateString();
        $year = Carbon::now();
        $year = $year->year;

        $session = new Session();
        $camps = $session->all();
        $modelPaym1 = new Paym1_providerPayments();
        $modelPaym1->paym1_paymentDate = $date;
        $modelPaym1->paym1_baseValue =  $session->get("value");
        $modelPaym1->paym1_paymentValue = $session->get("value");
        $modelPaym1->paym1_methodpayment = 1;
        $modelPaym1->paym1_concept = 1;
        $modelPaym1->paym1_year = $year;
        $modelPaym1->paym1_contactName = $session->get("paym9_commercialName");
        $modelPaym1->paym1_contactEmail = $session->get("paym9_mail");
        $modelPaym1->paym1_address = $session->get("paym9_mail");
        $modelPaym1->paym1_phone = $session->get("paym9_phone");
        $modelPaym1->paym1_attached = " ";
        $modelPaym1->paym1_certificate = " ";
        $modelPaym1->paym1_description = $session->get("subProduct");
        $modelPaym1->paym1_modulestatus = 1;
        $modelPaym1->paym1_status = 1;
        $modelPaym1->lg1_creatorId = 67957;
        $modelPaym1->pv1_id = $session->get("pv1_id");
        $modelPaym1->loc3_id = "";
        $modelPaym1->loc2_id = "";
        $modelPaym1->loc1_id = "";
        $modelPaym1->cl1_id = $session->get("paym4_id");
        $modelPaym1->lg1_userUpdate = "";
        $modelPaym1->deleted_at = "";
        $modelPaym1->save();

        $modelPv15 = new Pv15_statesRelations();
        $modelPaym1->pv15_start_date = $date;
        $modelPaym1->pv15_end_date =  $date;
        $modelPaym1->pv15_observation = $session->get("subProduct");
        $modelPaym1->pv15_modificationDate = "(NULL)";
        $modelPaym1->pv15_status = 1;
        $modelPaym1->pv15_createdDate = $date;
        $modelPaym1->pv1_id = $session->get("pv1_id");;
        $modelPaym1->conf5_id = 1;
        $modelPaym1->conf4_id = 1;
        $modelPaym1->lg1_creatorId = 67957;
        $modelPaym1->cl1_id = $session->get("paym4_id");;
        $modelPaym1->pv15_codigointerno1 = " ";
        $modelPaym1->pv15_codigointerno2 = " ";
        $modelPaym1->pv15_nombreinterno1 = " ";
        $modelPaym1->pv15_nombreinterno2 = " ";
        $modelPaym1->pv32_id = "(NULL)";
        $modelPaym1->pv15_acta = "(NULL)";
        $modelPaym1->pv33_id = "(NULL)";
        $modelPaym1->pv34_id = "(NULL)";
        $modelPaym1->save();

        return true;
    }
}
