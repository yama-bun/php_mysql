<?php
//関数1つに1つの機能のみもたせる
//1データベース接続
//2データを取得
//3カテゴリー名を表示

//1.データベース接続
//引数：なし
//返り値：接続結果を返す
require_once('env.php');

class Dbc
{

    protected $table_name;
    protected function dbConnect()
    {

        $host   = DB_HOST;
        $dbname = DB_NAME;
        $user   = DB_USER;
        $pass   = DB_PASS;
        $dsn    = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $dbh = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                // echo '接続成功';
            ]);
        } catch (PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit();
        };
        return $dbh;
    }
    //2.データを取得する
    //引数：なし
    //返り値：取得したデータ
    public function getAll()
    {
        $dbh = $this->dbConnect();
        //①SQLの準備
        $sql = "select * from $this->table_name";
        // ②SQLの実行
        $stmt = $dbh->query($sql);
        //③SQLの結果を受け取る
        $result = $stmt->fetchall(\PDO::FETCH_ASSOC);
        // var_dump($result);
        return $result;
        $dbh = null;
    }



    public function getBlog($id)
    {
        if (empty($id)) {
            exit('IDが不正です。');
        }


        $dbh = $this->dbConnect();

        // SQL準備
        $stmt = $dbh->prepare("select * from $this->table_name where id = :id");
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();

        //結果を表示
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        // var_dump($result);

        if (!$result) {
            exit('ブログがありません');
        }

        return $result;
    }

    public function delete($id)
    {
        if (empty($id)) {
            exit('IDが不正です。');
        }


        $dbh = $this->dbConnect();

        // SQL準備
        $stmt = $dbh->prepare("delete from $this->table_name where id = :id");
        $stmt->bindValue(':id', (int)$id, \PDO::PARAM_INT);

        //SQL実行
        $stmt->execute();
        echo 'ブログを削除しました';

    }


}
