<?php
namespace App\Services;

use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use App\Models\Venda;
use App\Models\ConfigNota;
use App\Models\Certificado;
use NFePHP\NFe\Complements;
use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\Legacy\FilesFolders;
use NFePHP\Common\Soap\SoapCurl;
use App\Models\Tributacao;
use App\Models\NFeReferecia;
use App\Models\IBPT;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

class NFeService{

	public function __construct($config, $emitente){
		
		$this->tools = new Tools(json_encode($config), Certificate::readPfx($emitente->certificado, $emitente->senha));
		$this->tools->model(55);
		
	}
}