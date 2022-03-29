<?php
    class Etat
    {
        Private $idetat;
        Private $libetat;

        Public function __construct(string $idetat='', string $libetat='')
        {
            $this->idetat = $idetat;
            $this->libetat = $libetat;
        }

        Public function Getidetat(){return $this->idetat;}
        Public function Getlibetat(){return $this->libetat;}

        Public function Setidetat($e){$this->idetat=$e;}
        Public function Setlibetat($e){$this->libetat=$e;}

        Public function GetByID($pdo)
        {
            $stmt = $pdo->prepare('SELECT * FROM etat WHERE idetat = :idetat');
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $this->idetat = $row['idetat'];
            $this->libetat = $row['libetat'];
        }

        Public function DelBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE etat SET supetat = 1 WHERE idetat = :idetat');
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function SaveBDD($pdo)
        {
            $stmt = $pdo->prepare('UPDATE etat SET libetat= :libetat WHERE idetat = :idetat');
            $stmt->bindValue(':idetat',$this->idetat, PDO::PARAM_STR);
            $stmt->bindValue(':libetat',$this->libetat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function AddBDD($pdo)
        {
            $stmt = $pdo->prepare("INSERT INTO etat (idetat, libetat, supetat) VALUES (NULL, :libetat, 0);");
            $stmt->bindValue(':libetat',$this->libetat, PDO::PARAM_STR);
            $stmt->execute();
        }

        Public function CountBDD($pdo)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM etat WHERE supetat = 0");
            $stmt->execute();
            $records = $stmt->fetch();
            return $records['allcount'];
        }

        Public function CountParamBDD($pdo,$searchQuery,$searchArray)
        {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM etat WHERE supetat = 0 " . $searchQuery);
            $stmt->execute($searchArray);
            $records = $stmt->fetch();
            return $records['allcount'];
        }
    }
?>