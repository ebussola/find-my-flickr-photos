<html>
<head>
    <title>Find my Flickr photos (visual)</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <script>
        <?php if ($this->config['debug']) :?>
            window['ga-disable-UA-48289597-1'] = true;
        <?php endif?>

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

        function click_like(value) {
            ga('send', 'event', 'like', value);
            alert('Muito obrigado pelo voto (seja lá qual foi)');
        }

    </script>
</head>
<body>
<h1>Find my Flickr Photos</h1>

<?php echo $this->__raw()->content?>

<p style="clear:left">
    Clique no like caso tenha gostado da idéia ou dislike caso não faça o menor sentido hehehe<br />
    <a href="javascript:void(0);" onclick="click_like('like')"><img src="like.png" width="60" /></a>
    <a href="javascript:void(0);" onclick="click_like('dislike')"><img src="dislike.jpg" width="48" /></a>
</p>
</body>
</html>