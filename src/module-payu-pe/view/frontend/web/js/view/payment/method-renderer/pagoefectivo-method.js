define(["Eloom_Payment/js/cash"],function(a){return a.extend({defaults:{template:"Eloom_PayUPe/payment/pagoefectivo-form",code:"eloom_payments_payu_pagoefectivo"},initialize:function(){this._super();return this},isActive:function(){return void 0!==window.checkoutConfig.payment[this.getCode()]?window.checkoutConfig.payment[this.getCode()].isActive:!1},isInSandboxMode:function(){return window.checkoutConfig.payment.eloom_payments_payu.isInSandboxMode},isTransactionInTestMode:function(){return window.checkoutConfig.payment.eloom_payments_payu.isTransactionInTestMode},
getLogoUrl:function(){if(this.isActive())return window.checkoutConfig.payment[this.getCode()].url.logo}})});
