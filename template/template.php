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

        function login_flickr(el) {
            ga('send', 'event', 'login_flickr', 'clicked');
        }

        function click_like(value) {
            ga('send', 'event', 'like', value);
            alert('Muito obrigado pelo voto!');
        }

    </script>
</head>
<body style="padding: 20px">
<h1>Find my Flickr Photos</h1>

<?php echo $this->__raw()->content?>

<hr />

<p style="clear:left">
    Clique no like caso tenha gostado da idéia ou dislike caso não faça o menor sentido.<br />
    <a href="javascript:void(0);" onclick="click_like('like')"><img src="like.png" width="60" /></a>
    <a href="javascript:void(0);" onclick="click_like('dislike')"><img src="dislike.jpg" width="48" /></a>
</p>

<p>

    <!-- Begin MailChimp Signup Form -->
    <link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif;  width:250px;}
        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
    </style>
<div id="mc_embed_signup">
    <form action="http://ebussola.us3.list-manage.com/subscribe/post?u=5a2b2934fcb8857ad6274c1dd&amp;id=7a5460128e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <label for="mce-EMAIL">Se inscreva para ficar sabendo das próximas atualizações</label>
        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;"><input type="text" name="b_5a2b2934fcb8857ad6274c1dd_7a5460128e" value=""></div>
        <div class="clear"><input type="submit" value="Inscrever" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </form>
</div>

<!--End mc_embed_signup-->

</p>

<!-- UserVoice JavaScript SDK (only needed once on a page) -->
<script>(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/XM3HApPJMhVArd7sQeFinA.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()</script>

<!-- A tab to launch the Classic Widget -->
<script>
    UserVoice = window.UserVoice || [];
    UserVoice.push(['showTab', 'classic_widget', {
        mode: 'feedback',
        primary_color: '#cc6d00',
        link_color: '#007dbf',
        forum_id: 242821,
        tab_label: 'Feedback',
        tab_color: '#cc0000',
        tab_position: 'top-left',
        tab_inverted: false
    }]);
</script>
</body>
</html>