<!doctype html>
<html lang="en">
<head>
    <!-- Other Tags -->

    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />
    <script src="https://applepay.cdn-apple.com/jsapi/v1/apple-pay-sdk.js"></script>
    <!-- Moyasar Scripts -->
    <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>
    <!-- Download CSS and JS files in case you want to test it locally, but use CDN in production -->
</head>

<body>
<div class="mysr-form"></div>
</body>
<script>
    Moyasar.init({
        element: '.mysr-form',
        // Amount in the smallest currency unit.
        // For example:
        // 10 SAR = 10 * 100 Halalas
        // 10 KWD = 10 * 1000 Fils
        // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
        amount: {{$data['total']}} * 100,
        currency: 'SAR',
        description: 'New transaction',
        publishable_api_key: '{{ config('services.moyasar.publishable_key') }}',
        callback_url: '{{ $data['call_back']??(route('moyasar.callback',['total'=>$data['total'],'user_id'=>$data['user_id'],'type'=>$data['type'],'Authorization'=>request()->header('auth_token')])) }}',
        methods: ['creditcard','stcpay','applepay'],
        apple_pay: {
            country: 'SA',
            label: 'Charge Wallet',
            validate_merchant_url: 'https://api.moyasar.com/v1/applepay/initiate',
        },
    })
</script>
<script>
    document.addEventListener("keydown", function (event){
        if ((event.ctrlKey || event.metaKey) ) {
            event.preventDefault();
            console.log('Copy command prevented');
        }
    });
    document.addEventListener('contextmenu',
        event => event.preventDefault()
    );
</script>
<script>
    function onApplePayButtonClicked() {

        if (!ApplePaySession) {
            return;
        }

        // Define ApplePayPaymentRequest
        const applePayPaymentRequest = {
            countryCode: 'SR',
            currencyCode: 'SAR',
            // make sure amex is enabled on your moyasar account, remove it otherwise.
            supportedNetworks: ['mada','visa', 'masterCard', 'amex'],
            merchantCapabilities: ['supports3DS'],
            total: { label: 'Charge Wallet', amount: {{$data['total']}} * 100 },
        }

        // Starting the Apple Pay Session
        const session = new ApplePaySession(3, applePayPaymentRequest);

        session.onpaymentauthorized = event => {
            const token = event.payment.token;

            // prepare request for moyasar
            let body = {
                'amount': applePayPaymentRequest.total.amount * 100,
                'currency': applePayPaymentRequest.currencyCode,
                'description': 'My Awsome Order #1234',
                'publishable_api_key': '{{ config('services.moyasar.publishable_key') }}',
                'source': {
                    'type': 'applepay',
                    'token': token
                },
                'metadata':{
                    'order': '1234'
                }
            };

            // send the request
            fetch('https://api.moyasar.com/v1/payments', {
                method: 'post',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body)
            })
                .then(response => response.json())
                .then(payment => {

                    if (!payment.id) {
                        // TODO: Handle validation or API authorization error
                    }

                    if (payment.status != 'paid') {
                        session.completePayment({
                            status: ApplePaySession.STATUS_FAILURE,
                            errors: [
                                payment.source.message
                            ]
                        });

                        return;
                    }

                    // TODO: Save payment to your backend and complete your business logic

                    // Compleate payment with success
                    session.completePayment({
                        status: ApplePaySession.STATUS_SUCCESS
                    });
                })
                .catch(error => {
                    session.completePayment({
                        status: ApplePaySession.STATUS_FAILURE,
                        errors: [
                            error.toString()
                        ]
                    });
                });
        };

        session.begin();


    }
</script>
</html>
