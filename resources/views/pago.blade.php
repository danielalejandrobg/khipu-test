<!DOCTYPE html>
<html>
<head>
    <title>Realizar pago con Khipu</title>
    <script src="https://js.khipu.com/v1/kws.js"></script>
</head>
<body>
    <h1>Proceso de pago</h1>




    <div id="khipu-web-root"></div>

    <script>
        const callback = (result) => {
            console.log('callback invoked:', result);
        };

        const options = {
            mountElement: document.getElementById('khipu-web-root'),
            modal: true,
            modalOptions: {
                maxWidth: 450,
                maxHeight: 860,
            },
            options: {
                style: {
                    primaryColor: '#8347AD',
                    fontFamily: 'Roboto',
                },
                skipExitPage: false,
            }
        };

        const khipu = new Khipu();
        khipu.startOperation("{{ $payment_id }}", callback, options);
    </script>






</body>
</html>
