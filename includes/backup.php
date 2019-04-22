<?php
    class DB_Functions{
        private $conn;
        function __construct(){
            require_once 'DB_Connect.php';
            $db = new Db_Connect();
            $this->conn = $db->connect();
        }
        function __destruct(){

        }

        /*Create admin*/
        public function adminRegs($username, $password){
            $uuid = uniqid('', true);
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"];
            $salt = $hash["salt"];

            $stmt = $this->conn->prepare("INSERT INTO `master_admin` (`unique_id`, `email`, `encrypted_password`, `salt`) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $uuid, $username, $encrypted_password, $salt);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `master_admin` WHERE email = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*if admin exist*/
        public function adminExist($username){
            $stmt = $this->conn->prepare("SELECT `email` FROM `master_admin` WHERE `email` = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*admin login*/
        public function adminLogin($username, $password){
            $stmt = $this->conn->prepare("SELECT `admin_id`, `unique_id`, `email`, `encrypted_password`, `salt` FROM `master_admin` WHERE `email` = ?");
            $stmt->bind_param("s",$username);
            if ($stmt->execute()) {
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                $salt = $user['salt'];
                $encrypted_password = $user['encrypted_password'];
                $hash = $this->checkhashSSHA($salt, $password);
                if($encrypted_password == $hash){
                    return $user;
                }
            }
            else{
                return NULL;
            }
        }

        /*create board*/
        public function saveNewBoard($newboard){
            $stmt = $this->conn->prepare("INSERT INTO `board`(`board_name`) VALUES (?)");
            $stmt->bind_param("s",$newboard);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `board` WHERE `board_name` = ?");
                $stmt->bind_param("s", $newboard);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*if board exist*/
        public function ifBoardExist($newboard){
            $stmt = $this->conn->prepare("SELECT `board_id` FROM `board` WHERE `board_name` = ?");
            $stmt->bind_param("s", $newboard);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*get board list*/
        public function boardList(){
            $stmt = $this->conn->prepare("SELECT `board_id`, `board_name` FROM `board`");
            $stmt->execute();
            $stmt->bind_result($boards_id, $board_name);
            $boardArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['board_id'] = $boards_id;
                $temp['board_name'] = $board_name;
                array_push($boardArray, $temp);
            }
            return $boardArray;
        }

        /*Create standard*/
        public function saveNewStandard($newstandard){
            $stmt = $this->conn->prepare("INSERT INTO `standard`(`standard_title`) VALUES (?)");
            $stmt->bind_param("s",$newstandard);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `standard` WHERE `standard_title` = ?");
                $stmt->bind_param("s", $newstandard);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*if standard exist*/
        public function ifStandardExist($newstandard){
            $stmt = $this->conn->prepare("SELECT `standard_id` FROM `standard` WHERE `standard_title` = ?");
            $stmt->bind_param("s", $newstandard);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*get standard list*/
        public function standardList(){
            $stmt = $this->conn->prepare("SELECT `standard_id`, `standard_title` FROM `standard`");
            $stmt->execute();
            $stmt->bind_result($class_id, $class_title);
            $standardArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['standard_id'] = $class_id;
                $temp['standard_title'] = $class_title;
                array_push($standardArray, $temp);
            }
            return $standardArray;
        }

        /*create subject*/
        public function saveNewSubject($newsubject){
            $stmt = $this->conn->prepare("INSERT INTO `subjects`(`subject_title`) VALUES (?)");
            $stmt->bind_param("s",$newsubject);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `subjects` WHERE `subject_title` = ?");
                $stmt->bind_param("s", $newsubject);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*if subject exist*/
        public function ifSubjectExist($newsubject){
            $stmt = $this->conn->prepare("SELECT `sub_id` FROM `subjects` WHERE `subject_title` = ?");
            $stmt->bind_param("s", $newsubject);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*get subject list*/
        public function subjectDropdown(){
            $stmt = $this->conn->prepare("SELECT `sub_id`, `subject_title` FROM `subjects`");
            $stmt->execute();
            $stmt->bind_result($sub_id, $sub_title);
            $subjectArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['sub_id'] = $sub_id;
                $temp['subject_title'] = $sub_title;
                array_push($subjectArray, $temp);
            }
            return $subjectArray;
        }

        /*Import chapter csv file*/
        public function newChapters($new_board, $new_class, $new_subject, $chapter_title){
            $stmt = $this->conn->prepare("INSERT INTO `master_chapter`(`board_id`, `class_id`, `subject_id`, `chapter_title`) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss",$new_board, $new_class, $new_subject, $chapter_title);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*get chapter list as per board, standard, subject etc*/
        public function loadChapterList($board, $standard, $subject){
            $stmt = $this->conn->prepare("SELECT `chapter_id`, `chapter_title` FROM `master_chapter` WHERE `board_id`= ? AND `class_id` = ? AND `subject_id` = ?");
            $stmt->bind_param("sss",$board, $standard, $subject);
            $stmt->execute();
            $stmt->bind_result($chapter_id, $chapter_title);
            $chapterArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['chapter_id'] = $chapter_id;
                $temp['chapter_title'] = $chapter_title;
                array_push($chapterArray, $temp);
            }
            return $chapterArray;
        }

        /*Upload new chapter's multiple video*/
        public function newChapterVideo($board, $standard, $subject, $chapter, $title, $vurl, $status){
            $stmt = $this->conn->prepare("INSERT INTO `master_video`(`board_id`, `standard_id`, `subject_id`, `chapter_id`, `video_title`, `video_url`, `video_status`) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssss", $board, $standard, $subject, $chapter, $title, $vurl, $status);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*if chapter video exist*/
        public function ifChapterVideoExist($board, $standard, $subject, $chapter, $title, $vurl){
            $stmt = $this->conn->prepare("SELECT `video_id` FROM `master_video` WHERE `board_id` = ? AND `standard_id` = ? AND `subject_id` = ? AND `chapter_id` = ? AND `video_title` = ? AND `video_url` = ?");
            $stmt->bind_param("ssssss", $board, $standard, $subject, $chapter, $title, $vurl);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*Import student csv file*/
        public function bulkStudentUpload($new_board, $new_standard, $fn, $ln, $username, $password, $status){
            $uuid = uniqid('', true);
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"];
            $salt = $hash["salt"];

            $stmt = $this->conn->prepare("INSERT INTO `master_student`(`unique_id`, `board_id`, `standard`, `firstname`, `lastname`, `email`, `encrypted_password`, `salt`, `status`) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssssss", $uuid, $new_board, $new_standard, $fn, $ln, $username, $encrypted_password, $salt, $status);
            $result = $stmt->execute();
            $stmt->close();
        }

        /*create individual student profile*/
        public function singleStudentProfile($board, $standard, $firstname, $lastname, $username, $password, $status){
            $uuid = uniqid('', true);
            $hash = $this->hashSSHA($password);
            $encrypted_password = $hash["encrypted"];
            $salt = $hash["salt"];
            $stmt = $this->conn->prepare("INSERT INTO `master_student`(`unique_id`, `board_id`, `standard`, `firstname`, `lastname`, `email`, `encrypted_password`, `salt`, `status`) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssssss", $uuid, $board, $standard, $firstname, $lastname, $username, $encrypted_password, $salt, $status);
            $result = $stmt->execute();
            $stmt->close();

            if($result){
                $stmt = $this->conn->prepare("SELECT * FROM `master_student` WHERE email = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                return $user;
            }
            else{
                return false;
            }
        }

        /*if individual student exist*/
        public function singleStudentExist($username){
            $stmt = $this->conn->prepare("SELECT `student_id` FROM `master_student` WHERE `email` = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0){
                $stmt->close();
                return true;
            }
            else{
                $stmt->close();
                return false;
            }
        }

        /*admin login*/
        public function studentLogin($username, $password){
            $stmt = $this->conn->prepare("SELECT `student_id`, `unique_id`, `email`, `encrypted_password`, `salt` FROM `master_student` WHERE `email` = ?");
            $stmt->bind_param("s",$username);
            if ($stmt->execute()) {
                $user = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                $salt = $user['salt'];
                $encrypted_password = $user['encrypted_password'];
                $hash = $this->checkhashSSHA($salt, $password);
                if($encrypted_password == $hash){
                    return $user;
                }
            }
            else{
                return NULL;
            }
        }

        /*load chapter name*/
        public function vidoechapterList($student_id, $subject_id){
            $stmt = $this->conn->prepare("SELECT master_chapter.chapter_id, master_chapter.chapter_title FROM master_chapter LEFT JOIN master_student ON master_student.board_id = master_chapter.board_id AND master_student.standard = master_chapter.class_id WHERE master_chapter.subject_id = ? AND master_student.student_id = ?");
            $stmt->bind_param("ss",$student_id, $subject_id);
            $stmt->execute();
            $stmt->bind_result($chapter_id, $chapter_title);
            $vidoechapterArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['chapter_id'] = $chapter_id;
                $temp['chapter_title'] = $chapter_title;
                array_push($vidoechapterArray, $temp);
            }
            return $vidoechapterArray;
        }

        /*Get lecture video*/
        public function lectureVideo($subjectId, $chapterId){
            $stmt = $this->conn->prepare("SELECT master_video.video_title, master_video.video_url FROM master_video LEFT JOIN master_student ON master_video.board_id = master_student.board_id AND master_video.standard_id = master_student.standard WHERE master_video.subject_id = ? AND master_student.student_id = ? AND master_video.video_status = 1");
            $stmt->bind_param("ss",$subjectId, $chapterId);
            $stmt->execute();
            $stmt->bind_result($vtitle, $file_path);
            $videoArray = array();
            while($stmt->fetch()){
                $temp = array();
                $temp['video_title'] = $vtitle;
                $temp['video_url'] = $file_path;
                
                array_push($videoArray, $temp);
            }
            return $videoArray;
        }

        /**
        * Encrypting password
        * @param password
        * returns salt and encrypted password
        */
        public function hashSSHA($password){
            $salt = sha1(rand());
            $salt = substr($salt, 0, 10);
            $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
            $hash = array("salt" => $salt, "encrypted" => $encrypted);
            return $hash;
        }

        /**
        * Decrypting password
        * @param salt, password
        * returns hash string
        */
        public function checkhashSSHA($salt, $password){
            $hash = base64_encode(sha1($password . $salt, true) . $salt);
            return $hash;
        }
    }
?>