<?php

abstract class DatabaseService
{
    protected static function query($sql, $data, $className = NULL)
    {
        $result = NULL;
        
        try {
            $pdo = new PDO("pgsql:host=localhost dbname=planon user=postgres password=123456");
            $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            // executa a instrução SQL
            $consulta = $pdo->prepare( $sql );
            $exec = $consulta->execute($data);
            
            if($className != NULL)
            {
                $result = $consulta->fetchAll(PDO::FETCH_CLASS, $className);
            }
            else
            {
                $result = $consulta->fetchAll();
            }
            
            // TODO - fechar a conexao
            $pdo = null;
            
            return $result;
        } catch (PDOException  $e) {
            throw $e;
            //echo $e->getMessage();
        }
    }
}