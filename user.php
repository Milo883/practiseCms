<?php

    define('ACTION_DASHBOARD', 'dashboard');
    define('ACTION_SEARCH', 'search');
    define('ACTION_SEARCH_FORM', 'searchForm');
    define('ACTION_ARTICLE_FORM', 'articleForm');
    define('ACTION_INSERT_ARTICLE', 'insertArticle');
    define('ACTION_ARTICLE_SAVED', 'articleSaved');
    define('ACTION_LOGOUT', 'logout');



//    ini_set('display_errors', 1);
//    error_reporting(E_ALL);

    include("bootstrap.php");

	if (!isset($_SESSION['loggedIn'])) { 
		$_SESSION['loggedIn'] = false ;
	}
	
	if(!isLoggedIn()) {
		header('Location: /test/index.php?msg=noPermissions');
	}

    $action = 'dashboard';
    $articles = [];
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case ACTION_DASHBOARD:
                $action = ACTION_DASHBOARD;

                $articles = getArticles($db);

                break;

            case ACTION_SEARCH_FORM:
                $action = ACTION_SEARCH_FORM;

                break;

            case ACTION_SEARCH:
                $action = ACTION_SEARCH;

                $keyword = $_GET['search'];

                if (strlen($keyword) < 3) {
                    $result = 'Input nije validan.';
                } else {
                    if (searchUsers($keyword)) {
                        $result = 'korisnik sa username-om: ' . $keyword . ' je pronadjen';
                    } else {
                        $result = 'korisnik sa username-om: ' . $keyword . ' nije pronadjen';
                    }
                }

                break;

            case ACTION_ARTICLE_FORM:
                $action = ACTION_ARTICLE_FORM;

                break;

            case ACTION_INSERT_ARTICLE:
                $action = ACTION_ARTICLE_SAVED;

                try {
                    persistArticle($db, $_POST);
                } catch (\Exception $e) {
                    echo 'doslo je do greske prilikom snimanja u bazu.';
                    die();
                }

                break;

            case ACTION_LOGOUT:
                logOut();
                header('Location: /test/index.php');

                break;

            default:
                throw new \InvalidArgumentException('Action not implemented.');

        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>User</title>
</head>
<body>

    <ul>
        <li><a href="/test/user.php?action=<?php echo ACTION_DASHBOARD ?>" title="Dashboard">Dashboard</a></li>
        <li><a href="/test/user.php?action=<?php echo ACTION_SEARCH_FORM ?>" title="Search">Search</a></li>
        <li><a href="/test/user.php?action=<?php echo ACTION_ARTICLE_FORM ?>" title="Search">Insert article</a></li>
        <li><a href="/test/user.php?action=<?php echo ACTION_LOGOUT ?>" title="Logout">Logout</a></li>
    </ul>

<?php

switch ($action) {
    case ACTION_SEARCH_FORM:
?>
    <form action="" method="get">
        <input type="text" name="search" placeholder="Pretraga" />
        <input type="submit" value="Pretraga" />

        <input type="hidden" name="action" value="search" />
    </form>
<?php
        break;
    case ACTION_SEARCH:
?>
    <p><?=$result?></p>
<?php
        break;

    case ACTION_ARTICLE_FORM:
?>
    <form action="?action=<?=ACTION_INSERT_ARTICLE?>" method="post">
        <input type="text" name="title" placeholder="Title" />
        <input type="text" name="body" placeholder="Body" />
        <input type="text" name="description" placeholder="Description" />

        <input type="submit" value="Snimi" />
    </form>

<?php
        break;

    case ACTION_ARTICLE_SAVED:
?>
        <p>Vest je uspeshno snimljena!!!!</p>
<?php
        break;

    case ACTION_DASHBOARD:
        echo '<ul>';
        foreach ($articles as $article) {
            echo '<li><a href="/test/user.php?action=editArticle&articleId=' . $article['articleId'] . '">' . $article['title'] . ' - ' . date('d/m/Y H:i', strtotime($article['createdAt'])) . '</a></li>';
        }
        echo '</ul>';

        break;

}

?>



</body>
</html>