<?php

/* En klass vars uppgift är att hantera kurser i utbildningen. */ 
class CoursesRegister {
    private $db;

    function __construct() {
        //Anslutning till databasen
        $this->db = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBDATABASE); 

        //Felhantering
        if($this->db->connect_errno > 0) {
            die ("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    //Hämtar alla kurser
    function getCourses() {
       //SQL-fråga för att välja allt innehåll i tabellen course
       $sql = "SELECT * FROM course";
       $result = $this->db->query($sql);                    

       //Retunerar resultatet som en array
       return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Hämtar en specifik kurs
    function getSpecifikCourse($id) {
        $id = intval($id);
        //SQL-fråga för att hämta ut en specifik kurs baserat på id
        $sql = "SELECT * FROM course WHERE id = $id";
        $result = $this->db->query($sql);                    

        //Retunerar resultatet som en array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Uppdaterar en kurs
    function updateCourse($id, $code, $name, $progression, $syllabus) {
        $id = intval($id);
        //SQL-fråga för att uppdatera en kurs
        $sql = "UPDATE course SET code = '$code', name = '$name', progression = '$progression',
                syllabus = '$syllabus' WHERE id = $id;";
        
        return $this->db->query($sql);
    }

    //Hanterar kurser som läggs till
    function addCourse($code, $name, $progression, $syllabus) {
        //SQL-fråga för att lägga till värden i tabellen course
        $sql = "INSERT INTO course (code, name, progression, syllabus) VALUES ('$code', '$name', '$progression', '$syllabus');";

        return $this->db->query($sql);
    }

    //Raderar valda kurser
    function deleteCourse($id) {
        $id = intval($id);
        //SQL-fråga för att radera den kurs som är kopplad till id:et som är valt
        $sql = "DELETE FROM course WHERE id = $id";
        
        return $this->db->query($sql);
    }
} 

?>