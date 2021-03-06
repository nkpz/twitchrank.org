<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-134747651-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-134747651-1');
        </script>

        <script src="//use.edgefonts.net/bebas-neue;gudea.js"></script>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>SmashStreams</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
    </head>
    <body>
        <a href="https://github.com/nnjpp/smashstreams" class="github-badge"><img width="149" height="149" src="https://github.blog/wp-content/uploads/2008/12/forkme_right_orange_ff7600.png?resize=149%2C149" class="attachment-full size-full" alt="Fork me on GitHub" data-recalc-dims="1"></a>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-body">
                                <header>SmashStreams</header>
                                <smashgraphs streamdata={{ $data }} />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://embed.twitch.tv/embed/v1.js"></script>
    </body>
</html>
