<?php
/**
* 
* PayU Peru para Magento 2
* 
* @category     elOOm
* @package      Modulo PayUPe
* @copyright    Copyright (c) 2022 elOOm (https://eloom.tech)
* @version      2.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/
declare(strict_types=1);

namespace Eloom\PayUPe\Model\Ui\PagoEfectivo;

use Eloom\PayUPe\Gateway\Config\PagoEfectivo\Config as PagoEfectivoConfig;
use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Escaper;
use Magento\Framework\View\Asset\Repository;
use Magento\Store\Model\StoreManagerInterface;

class ConfigProvider implements ConfigProviderInterface {

	const CODE = 'eloom_payments_payu_pagoefectivo';

	protected $assetRepo;

	private $config;

	protected $escaper;

	protected $storeManager;

	private static $allowedCurrencies = ['PEN', 'USD'];

	public function __construct(Repository            $assetRepo,
	                            Escaper               $escaper,
	                            PagoEfectivoConfig    $pagoEfectivoConfig,
	                            StoreManagerInterface $storeManager) {
		$this->assetRepo = $assetRepo;
		$this->escaper = $escaper;
		$this->config = $pagoEfectivoConfig;
		$this->storeManager = $storeManager;
	}

	public function getConfig() {
		$store = $this->storeManager->getStore();
		$payment = [];
		$storeId = $store->getStoreId();
		$isActive = $this->config->isActive($storeId);
		if ($isActive) {
			$currency = $store->getCurrentCurrencyCode();
			if (!in_array($currency, self::$allowedCurrencies)) {
				return ['payment' => [
					self::CODE => [
						'message' =>  sprintf("Currency %s not supported.", $currency)
					]
				]];
			}

			$payment = [
				self::CODE => [
					'isActive' => $isActive,
					'instructions' => $this->getInstructions($storeId),
					'url' => [
						'logo' => $this->assetRepo->getUrl('Eloom_PayUPe::images/pago-efectivo.svg')
					]
				]
			];
		}

		return [
			'payment' => $payment
		];
	}

	protected function getInstructions($storeId): string {
		return $this->escaper->escapeHtml($this->config->getInstructions($storeId));
	}
}