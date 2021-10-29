<?php
/**
* 
* PayU Peru para Magento 2
* 
* @category     elOOm
* @package      Modulo PayUPe
* @copyright    Copyright (c) 2021 Ã©lOOm (https://eloom.tech)
* @version      1.0.3
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\PayUPe\Block\PagoEfectivo;

class Info extends \Eloom\PayU\Block\Info {

	public function getPaymentLink() {
		return $this->getInfo()->getAdditionalInformation('paymentLink');
	}

	public function getPdfLink() {
		return $this->getInfo()->getAdditionalInformation('pdfLink');
	}

	public function getBarCode() {
		return $this->getInfo()->getAdditionalInformation('barCode');
	}
}
