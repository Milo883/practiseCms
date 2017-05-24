<?php
	//logOut();
	//populateStorage();
	//die();


    /**
     * @param $params
     *
     * @return PDO
     */
    function connectToDatabase($params) {
        $dsn = sprintf('mysql:dbname=%s;host=%s', $params['name'], $params['hostname']);

        try {
            $pdo = new PDO($dsn, $params['user'], $params['pass']);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            var_dump($e->getCode());
            var_dump($e->getTrace());
            die();
        }

        return $pdo;
    }

    function persistArticle(Pdo $dbConnection, $params) {
        if (!saveArticleToDb($dbConnection, $params)) {
            throw new \Exception('Could not save item.');
        }

        return true;
    }

    function getArticles(Pdo $dbConnection) {
        $sql = "SELECT * FROM article where articleId = ";

        return $dbConnection->query($sql)->fetchAll(\Pdo::FETCH_ASSOC);
    }

    function saveArticleToDb(Pdo $dbConnection, $params) {
        $sql = "INSERT INTO article VALUES(null, '{$params['title']}', '{$params['body']}', '{$params['description']}', NOW())";

        return $dbConnection->exec($sql);
    }

	function logOut () {
		unset($_SESSION['loggedIn']);
	}

	function isLoggedIn() {
		
		if ($_SESSION['loggedIn']) {
			return true;
		}
		return false;
	}
	function searchUser($keyword) {
		$users = getUsers();
		foreach($users as $user){
			if ($keyword === $user->username) {
				return true;
			}
		}
		
		return false;
	}

	function logIn($username, $password) {
		$users = getUsers();
		foreach($users as $user){
			if (authoriseUser($username, $password, $user)) {
				$_SESSION['user'] = $username;
				$_SESSION['loggedIn'] = true;
			}
		}
	}
	
	function getUsers() {
		return json_decode(file_get_contents('storage.dat'));
	}
	
	function authoriseUser($username, $password, $user){
		if ($user->username === $username && $user->password === $password) {
			return true;
		}
		return false;
	}
	
	function populateStorage() {
		$users = array(
			['username' => 'admin', 'password' => 'test'],
			['username' => 'milo', 'password' => 'milo']
		);
		
		file_put_contents('storage.dat', json_encode($users));
	}
?>