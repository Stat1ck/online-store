<?php

    function indexAction($connect, $controllerName, $actionName, $user){

        $fname = htmlspecialchars(trim($_POST['fname']));
        $lname = htmlspecialchars(trim($_POST['lname']));
        $email = htmlspecialchars(trim($_POST['email']));
        $tel = htmlspecialchars(trim($_POST['tel']));
        $password = trim($_POST['password']);
        $password_repeat = trim($_POST['password_repeat']);
        $checkCon = $_POST['checkCon'];
        
        if((isset($fname)) && (!empty($fname))){
            
            if((isset($email)) && (!empty($email))){
                
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    
                    $sql = $connect->prepare("SELECT id FROM users WHERE email = ?");
                    $sql->execute([$email]);
                    $info = $sql->fetchAll();
                    
                    foreach($info as $email){
                        $resEmail = $email['id'];
                    }
                    
                    if(empty($resEmail)){
                        
                        if((!empty($tel)) && (isset($tel))){
                                            
                            $sql = $connect->prepare("SELECT id FROM users WHERE phone = ?");
                            $sql->execute([$tel]);
                            $info = $sql->fetchAll();
                                            
                            foreach($info as $phone){
                                $resTel = $phone['id'];
                            }
                                            
                        }else{
                            $tel = "none";
                        }
                        
                        if(empty($resTel)){
                
                            if((isset($password)) && (!empty($password))){
                                
                                if((isset($password_repeat)) && (!empty($password_repeat))){
                                
                                    if($password === $password_repeat){
                                        
                                        if((isset($checkCon)) && (!empty($checkCon))){
                                            
                                            if(!empty($_FILES['image']['name'])){
                                                
                                                $img_name = $_FILES['image']['name'];
                                                $img_type = $_FILES['image']['type'];
                                                $tmp_name = $_FILES['image']['tmp_name'];
                                                
                                                $img_explode = explode('.', $img_name);
                                                $img_ext = end($img_explode);
                                
                                                $extensions = ["jpeg", "png", "jpg", "gif"];
                                                
                                                if(in_array($img_ext, $extensions) === true){
                                                    
                                                    $types = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
                                                    
                                                    if(in_array($img_type, $types) === true){
                                                        
                                                        $time = time();
                                                        $new_img_name = $time.$img_name;
                                                        
                                                        if(move_uploaded_file($tmp_name, "img/avatars/".$new_img_name)){
                                                            
                                                            $successImg = true;
                                                        
                                                        }else{
                                                            
                                                            echo "Не удалось загрузить изображение!";
                                                            
                                                            $successImg = false;
                                                            
                                                        }
                                                        
                                                    }else{
                                                        
                                                        echo "Расширения изображения должны быть: jpeg, png, jpg, gif!";
                                                        
                                                        $successImg = false;
                                                        
                                                    }
                                                    
                                                }else{
                                                    
                                                    echo "Расширения изображения должны быть: jpeg, png, jpg, gif!";
                                                    
                                                    $successImg = false;
                                                    
                                                }
                                            }else{
                                                
                                                $new_img_name = "user.png";
                                                
                                            }
                                            
                                            if(!$successImg){
                                                
                                                $new_img_name = "user.png";
                                                
                                            }
                                            
                                            $unique_id = uniqid(rand(time(), 100000000), true);
                                            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                                            
                                            $sql = $connect->prepare("INSERT INTO users (unique_id, fname, lname, email, phone, password, avatar) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                            $sql->bindParam(1, $unique_id);
                                            $sql->bindParam(2, $fname);
                                            $sql->bindParam(3, $lname);
                                            $sql->bindParam(4, $email);
                                            $sql->bindParam(5, $tel);
                                            $sql->bindParam(6, $pass_hash);
                                            $sql->bindParam(7, $new_img_name);
                                            $sql->execute();
                                            
                                            $sql = $connect->prepare("SELECT unique_id FROM users WHERE unique_id = ?");
                                            $sql->execute([$unique_id]);
                                            $info = $sql->fetchAll();
                                            
                                            foreach($info as $user){
                                                $resId = $user['unique_id'];
                                            }
                                            
                                            if(!empty($resId)){
                                                
                                                echo "Вы зарегистрированы!";
                                                
                                                $_SESSION['user'] = $resId;
                                                $user = $resId;
                                                getUserInfo($connect, $user);
                                            
                                            }else{
                                                
                                                echo "Что-то пошло не так. Попробуйте снова!";
                                                
                                            }
                                            
                                        }else{
                                            echo "Необходимо принять условия политики обработки персональных данных!";
                                        }
                                        
                                    }else{
                                        
                                        echo "Пароли не совпадают!";
                                        
                                    }
                                
                                }else{
                                    
                                    echo "Повторите пароль!";
                                    
                                }
                                
                            }else{
                                
                                echo "Введите пароль!";
                                
                            }
                        
                        }else{
                            
                            echo "Такой телефон уже существует!";
                            
                        }
                    
                    }else{
                        
                        echo "Такая почта уже существует!";
                        
                    }
                
                }else{
                    
                    echo "Введите E-mail правильно! Пример: example@mail.ru";
                    
                }
                
            }else{
                
                echo "Введите E-mail!";
                
            }
            
        }else{
            
            echo "Введите имя!";
            
        }
        
    }

?>