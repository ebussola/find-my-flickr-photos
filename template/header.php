<html>
<head>
    <title>Find my Flickr photos (visual)</title>

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-48289597-1', 'ebussola.com');
        ga('send', 'pageview');

        function click_photo(el) {
            ga('send', 'event', 'photo', 'click');
        }

        function submit_form(el) {
            ga('send', 'event', 'form', 'submited');
        }

    </script>
</head>
<body>
<h1>Find my Flickr Photos</h1>