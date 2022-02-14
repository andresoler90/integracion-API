<?php

    if (!function_exists('generateString'))
    {
        /**
         * Realiza la creación de la contraseña por defecto con el estándar apropiado
         *
         * @return mixed|string
         */
        function generateString($cant = 10)
        {
            $newPassword = "";
            $acceptedChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for ($i=0; $i<$cant; $i++)
            {
                $aleatoryNumber = rand(0, strlen($acceptedChars)-1);
                $newPassword .= $acceptedChars[$aleatoryNumber];
            }
            return $newPassword;
        }
    }

    if (!function_exists('replaceSpecialCharacters'))
    {
        /**
         * Realiza la creación de la contraseña por defecto con el estándar apropiado
         *
         * @return mixed|string
         */
        function replaceSpecialCharacters($string, $tipo = null)
        {
            /*En caso de agregar otros caracteres como espacio o simbolos (/*-+) usar variable tipo para adicionar al array sin afectar los originales*/
            $no_permitidas = array ("A€", "Aˆ", "AŒ", "A’", "A¹", "A™", "Ã²", "A¬", "Ã±", "A±", "Â", "A‘", "A?", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "à", "è", "ì", "ò", "ù", "À", "È", "Ì", "Ò", "Ù", "ñ", "Ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã ", "Ã„", "Ã‹", "Ã³", "A³", "Aº", "Aš", "A¡", "A‰", "A ", "A“", "A©", "A¬", "A¨");
            $permitidas = array ("A", "E", "I", "O", "u", "U", "o", "i", "n", "n", "", "n", "n", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "o", "o", "u", "U", "a", "E", "I", "O", "e", "i", "e");
            /*if ($tipo==1)
            {
                array_push($no_permitidas, );
                array_push($permitidas, );
            }*/
            return str_replace($no_permitidas, $permitidas, $string);
        }
    }

    if (!function_exists('replaceSymbols'))
    {
        /**
         * Realiza la creación de la contraseña por defecto con el estándar apropiado
         *
         * @return mixed|string
         */
        function replaceSymbols($string)
        {
            /*En caso de agregar otros caracteres como espacio o simbolos (/*-+) usar variable tipo para adicionar al array sin afectar los originales*/
            $no_permitidas = array ("_", "-", "'", "\\", "/", "\"", "´", "‘", "¨");
            $permitidas = array ("", "", "", "", "", "", "", "", "");
            return str_replace($no_permitidas, $permitidas, $string);
        }
    }

    if (!function_exists('replaceEnter'))
    {
        /**
         * Realiza la creación de la contraseña por defecto con el estándar apropiado
         *
         * @return mixed|string
         */
        function replaceEnter($string)
        {
            /*En caso de agregar otros caracteres como espacio o simbolos (/*-+) usar variable tipo para adicionar al array sin afectar los originales*/
            $no_permitidas = array ("'", "\"", "´", "‘", "¨", "<br>", "\n", "PHP_EOL");
            $permitidas = array ("", "", "", "", "", "", "", "");
            return str_replace($no_permitidas, $permitidas, $string);
        }
    }

    if (!function_exists('paginateAdd'))
    {
        /**
         * Realiza la creación de la contraseña por defecto con el estándar apropiado
         *
         * @return mixed|string
         */
        function paginateAdd($items, $perPage = 10, $page = null, $options = [])
        {
            $page = $page ?: (Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
            $items = $items instanceof Illuminate\Support\Collection ? $items : Illuminate\Support\Collection::make($items);
            return new Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        }

    }

?>
