<?php
session_start();
class Conectar
{
	private static $nStr = array(array('cero', 'uno'),
            array('', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete',
                    'ocho', 'nueve', 'diez', 'once', 'doce', 'trece',
                    'catorce', 'quince', 'dieciséis', 'diecisite', 'dieciocho',
                    'diecinueve', 'veinte', 'veintiuno', 'veintidós',
                    'veintitres', 'veinticuatro', 'veinticinco', 'veintiseis',
                    'veintisiete', 'veintiocho', 'veintinueve', 100 => 'cien'),
            array('', '', '', 'treinta', 'cuarenta', 'cincuenta', 'sesenta',
                    'setenta', 'ochenta', 'noventa'),
            array('', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos',
                    'quinientos', 'seicientos', 'setecientos', 'ochocientos',
                    'novecientos'),
            array('', '', 'mil', 'millon', 'mil', 'billon', 'mil', 'trillon',
                    'mil', 'cuatrillon', 'mil', 'quintillon', 'mil',
                    'sextillón', 'mil', 'septillón', 'mil', 'octillon'),
            array('', '', 'mil', 'millones', 'mil', 'billones', 'mil',
                    'trillones', 'mil', 'cuatrillones', 'mil', 'quintillones',
                    'mil', 'sextillones', 'mil', 'septillones', 'mil',
                    'octillones', 'mil'));
					
    public function con()
	{
		//$con=new PDO("mysql:host=localhost;dbname=alfm","root","idios");
		$con=new PDO("mysql:host=localhost;dbname=alfm","root","mayra123");
		$con->query("SET NAMES 'utf8'");
        return $con;
        
	}
	public static function ruta()
	{
		return "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
       // return "http://192.168.1.33/alfmnorte/";
		//"http://10.16.11.161/alfmnorte/";
		//return "http://localhost/alfmnorte/";
		//10.16.11.155 tambien      define('BASEURL',dirname(__FILE__).'/');
		//192.168.1.2
	}
	
	public static function plantilla_menu()
	{
		switch ($_SESSION["ses_tipo"])
		 {
			case '1':
				require_once("public/layout/header.php"); //administrador
				break;
			case '2':
				require_once("public/layout/header_contra.php");// contratos
				break;
			case '3':
				require_once("public/layout/header_presu.php");// presupuesto
				break;
			case '4':
				require_once("public/layout/header_teso.php");// tesoreria
				break;
			case '5':
				require_once("public/layout/header_carte.php");// cartera
				break;
			case '6':
				require_once("public/layout/header_contab.php");// contabilidad
				break;
			case '7':
				require_once("public/layout/header_error.php");// error
				break;
			default:
				
				break;
		}
	}
	public static function eliminar_acentos($str){
	$a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','�»','ü','ý','ÿ','Ā','ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ','ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','�»','ļ','Ľ','ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ','Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','�»','ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǻ','�»','Ǽ','ǽ','Ǿ','ǿ');
	$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');
	return str_replace($a, $b, $str);
	}
	
	public static function FechaTexto($fe)
	{
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $dias[date('w',strtotime($fe))]." ".date('d',strtotime($fe))." de ".$meses[date('n',strtotime($fe))-1]. " del ".date('Y',strtotime($fe)) ;
	}
	public static function Mes_FechaTexto($fe)
	{
		$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return $meses[date('n',strtotime($fe))-1] ;
	}
    public static function FechaTexto2($fe)
	{
		
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		return date('d',strtotime($fe))." ".$meses[date('n',strtotime($fe))-1]. " ".date('Y',strtotime($fe)) ;
	}
	//******************************************************************************************************************
				//Numeros a letras
	//**********************************************************************************************************************
	private static function _num($n, $c = 1, $l = 1) {
        return ($n == 1 && !($l % 2)) || !$l ? '' : self::$nStr[$c][$n] . ' ';
    }
    /**
    * Convierte recursivamente un numero a letras
    * @param integer $lev Numero de cifras agrupadas en 3: Ej. 100101 = 2
    * @param srting $number Número a convetir a letras
    * @return string
    */
    private static function _i2str($lev, $number) {
        $int = intval($num = substr($number, 0, 3));
        $next = substr($number, 3);
        $str = ''; //echo "($lev|$num|$int|$number)<hr>\n"; //Debug
        if ($int) {
            if ($int == 100)
                $str = self::_num($int, 1);
            else {
                list($c, $d, $u) = $num;//centenas, decenas y unidad
                $str = $c ? self::_num($c, 3) : '';
                if (($du = (($d * 10) + $u)) < 30)
                    $str .= self::_num($du, $du == 1 && $lev < 2 ? 0 : 1, $lev);
                else {
                    $str .= $d ? self::_num($d, 2) . ($u ? 'y ' : '') : '';
                    $str .= $u ? self::_num($u, $u + $lev < 3 ? 0 : 1) : '';
                }
            }
            $str .= self::_num($lev, $int == 1 && ($lev % 2) ? 4 : 5)
                    . (preg_match('/^000+/', $next) ? self::_num($lev - 1, 5,
                                    !($lev % 2)) : '');
        }
        return $lev ? ($str . self::_i2str($lev - 1, $next)) : '';
    }
    /**
    * Convierte una cadena numerica o numero a letras
    * @param string $number
    * @return boolean|string
    */
    public static function toWord($number) {
        $less = preg_match('/^\-/', $number);
        $number = preg_replace('/[^0-9\.]/', '', $number);
        if (preg_match('/^(\d{1,54})$/', $number)) {
            $lev = (floor(strlen($number) / 3) + 1);
            $number = str_pad($number, ($lev * 3), '0', STR_PAD_LEFT);
            $result = self::_i2str($lev, $number);
            $result || ($result = self::_num(0, 0));
        } elseif (preg_match('/^\d{1,54}\.\d{1,54}$/', $number)) {
            list($number, $decimal) = explode('.', $number);
            $result = self::toWord($number) . ' punto ';
            for ($i = 0; $i < (strlen($decimal) - 1); $i++) {
                if ($decimal[$i])
                    break;
                $result .= self::_num(0, 0);
            }
            $result .= self::toWord($decimal);
        }
        return isset($result) ? ($less ? 'menos ' : '') . $result : FALSE;
    }
    /**
    * Convierte una cifra tipo moneda a letras
    * @param string $number
    * @return boolean|string
    */
    public static function NumeroLetras($number) {
        $number = preg_replace('/[^0-9\.\-]/', '', $number);
        if (preg_match('/^[\-]{0,1}(\d{1,54})$/', $number))
            $number .= '.00';
        elseif (!preg_match('/^[\-]{0,1}\d{1,54}\.\d{1,54}$/', $number))
            return FALSE;
        list($number, $decimal) = explode('.', $number);
        $number = self::toWord($number);
        if (!$number)
            return FALSE;
        if (preg_match('/(llones|llón)$/', $number))
            $number .= ' de pesos ';
        else
            $number = preg_match('/uno$/', $number) ? (preg_replace('/uno$/',
                            '', $number) . ' un peso ') : ($number . 'pesos ');
        $decimal = round($decimal[0] . $decimal[1] . '.' . substr($decimal, 2));
        return $number . $decimal . '/100 M.N.';
    }
	//*****************************************fin*******************************************************************
} 
?>