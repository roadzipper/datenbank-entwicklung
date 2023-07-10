<?php

class StaticHTML {

    public function head($title) {
        return '<!DOCTYPE html>
        <html lang="de">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $title . '</title>
            <link rel="stylesheet" href="css/uikit.min.css" />
            <script src="js/uikit.min.js"></script>
            <script src="js/uikit-icons.min.js"></script>
        </head>
        <body data-src="img/seaboard.jpg" style="background-size:cover; background-attachment: fixed;" uk-img>';
    }

    public function foot() {
        return '</body>
        </html>';
    }
 
    public function navbar($user) {
        return '<nav class="uk-navbar-container">
                    <div class="uk-container">
                        <div uk-navbar>
                            <div class="uk-navbar-left">
                                <ul class="uk-navbar-nav">
                                    <li class="uk-active"><a href="#">Board</a></li>
                                    <li><a href="#">Write</a></li>
                                </ul>
                            </div>
                            <div class="uk-navbar-right">
                                <ul class="uk-navbar-nav">
                                    <li><a href="#">Logged in as '.$user.'</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>';
    }

    public function row($row) {
        return '
        <article class="uk-comment uk-width-2-3" style="background-color: rgba(255,255,255,0.8);">
            <header class="uk-comment-header">
            <div class="uk-grid-medium uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
                <img class="uk-comment-avatar" src="img/users/' . $row['username'] . '.png" width="80" height="80">
            </div>
            <div class="uk-width-expand">
                <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">' . $row['username'] . '</a></h4>
                <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                    <li><a href="#">' . $row['created'] . '</a></li>
                    <li><span uk-icon="icon: eye"></span> <span class="uk-margin-left uk-badge">' . $row['views'] . '</span></li>
                    <li><span uk-icon="icon: heart"></span> <span class="uk-margin-left uk-badge">TBD</span></li>
                    <li><a href="#" class="uk-icon-button" uk-icon="comment"></a></li>
                </ul>
            </div>
            </header>
            <div class="uk-comment-body uk-margin-left">
            <h3>' . $row['title'] . '</h3>
            <p>' . substr($row['content'], 0, 500) . '<a href="read.php?postid=' . $row['pid'] . '"><span uk-icon="icon: more"></span> mehr</a></p>
            </div>
        </article>
        <hr class="uk-divider-icon">';
    }

    public function post($post) {
        return '
        <article class="uk-comment uk-width-2-3" style="background-color: rgba(255,255,255,0.8);">
            <header class="uk-comment-header">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="img/users/' . $post['username'] . '.png" width="80" height="80">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">' . $post['username'] . '</a></h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><a href="#">' . $post['created'] . '</a></li>
                            <li><span uk-icon="icon: eye"></span> <span class="uk-margin-left uk-badge">' . $post['views'] . '</span></li>
                            <li><span uk-icon="icon: heart"></span> <span class="uk-margin-left uk-badge">TBD</span></li>
                            <li><a href="#" class="uk-icon-button" uk-icon="comment"></a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body uk-margin-left">
                <h3>' . $post['title'] . '</h3>
                <p>' . substr($post['content'], 0, 500) . '<a href="read.php?pid=' . $post['pid'] . '"><span uk-icon="icon: more"></span> mehr</a></p>
            </div>
        </article>
        <hr class="uk-divider-icon">';
    }
    

    public function comment($comment) {
        return '
        <article class="uk-comment uk-comment-primary uk-margin-small-top">
            <header class="uk-comment-header">
                <div class="uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="uk-comment-avatar" src="img/users/' . $comment['username'] . '.png" width="40" height="40">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">' . $comment['username'] . '</a></h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><a href="#">' . $comment['created'] . '</a></li>
                        </ul>
                    </div>
                </div>
            </header>
            <div class="uk-comment-body uk-margin-left">
                <p>' . $comment['content'] . '</p>
            </div>
        </article>
        ';
    }

}
