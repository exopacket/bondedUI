<?php

    $get_url = "get-vue.php";
    if(isset($_GET['filepath'])) {
        $get_url = "get-vue.php?filepath=" . urlencode($_GET['filepath']);
    }

?>

<!DOCTYPE html>
<html>

    <head>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/vue@3"></script>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    </head>

    <body>

        <div id="app">

        </div>

    </body>

    <script>
        function finishLoading(obj) {

            Vue.createApp(obj).mount("#app");

        }
    </script>
    <script src="<?php echo $get_url; ?>"></script>

</html>
