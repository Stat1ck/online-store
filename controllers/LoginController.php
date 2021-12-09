<?php

    function indexAction($connect, $controllerName, $actionName, $user){

        $email = htmlspecialchars(trim($_POST['email']));
        $tel = htmlspecialchars(trim($_POST['tel']));
        $password = trim($_POST['password']);
        $checkCook = $_POST['checkCook'];
        
        if(((!empty($email)) && (isset($email))) || ((!empty($tel)) && (isset($tel)))){
            
            if((!empty($password)) && (isset($password))){
                
                $sql = $connect->prepare("SELECT password FROM users WHERE email = :email OR phone = :tel");
                $sql->execute([
                        ':email' => $email,
                        ':tel' => $tel
                    ]);
                $info = $sql->fetchAll();
                    
                foreach($info as $user){
                    $resPass = $user['password'];
                }
                
                if((!empty($resPass)) && (isset($resPass))){
                    
                    if(password_verify($password, $resPass)){
                        
                        $sql = $connect->prepare("SELECT unique_id FROM users WHERE password = :pass AND (email = :email OR phone = :tel)");
                        $sql->execute([
                                ':email' => $email,
                                ':tel' => $tel,
                                ':pass' => $resPass
                            ]);
                        $info = $sql->fetchAll();
                            
                        foreach($info as $user){
                            $resUser = $user['unique_id'];
                        }
                    
                        if((!empty($checkCook)) && (isset($checkCook))){
                            
                            $_SESSION['setCookUser'] = $resUser;  
                            $_SESSION['user'] = $resUser;
                            $user = $resUser;
                            getUserInfo($connect, $user);
                            
                            echo "Вы вошли!";
                            
                        }else{
                            
                            $_SESSION['user'] = $resUser;
                            $user = $resUser;
                            getUserInfo($connect, $user);
                            
                            echo "Вы вошли!";
                            
                        }
                        
                    }else{
                        
                        echo "Неверный пароль!";
                        
                    }
                    
                }else{
                    
                    echo "E-mail или телефон неверный!";
                    
                }
                
            }else{
                    
                echo "Введите пароль!";
                    
            }
            
        }else{
            
            echo "Введите почту или телефон!";
            
        }
        
    }
        
?>