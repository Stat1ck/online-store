<?php 

    function changemaindataAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }else{
            
            $p_fname = htmlspecialchars(trim($_POST['p_fname']));
            $p_lname = htmlspecialchars(trim($_POST['p_lname']));
            $p_email = htmlspecialchars(trim($_POST['p_email']));
            $p_phone = htmlspecialchars(trim($_POST['p_phone']));
            
            if(!empty($p_fname)){
                if(!empty($p_email)){
                    if($p_email !== $_SESSION['userEmail']){
                        if(filter_var($p_email, FILTER_VALIDATE_EMAIL)){
                        
                            $sql = $connect->prepare("SELECT id FROM users WHERE email = ?");
                            $sql->execute([$p_email]);
                            $info = $sql->fetchAll();
                            
                            foreach($info as $email){
                                $resID = $email['id'];
                            }
                            
                            if(empty($resID)){
                                $resEmail = $p_email;
                            }else{
                                echo "Такая почта уже существует!";
                                exit();
                            }
                        }else{
                            echo "Введите почту верно!";
                            exit();
                        }
                    }else{
                        $resEmail = $p_email;
                    }
                    
                    if(!empty($p_phone)){
                        
                        if($p_phone !== $_SESSION['userPhone']){
                            
                            $sql = $connect->prepare("SELECT id FROM users WHERE phone = ?");
                            $sql->execute([$p_phone]);
                            $info = $sql->fetchAll();
                                                
                            foreach($info as $phone){
                                $resTel = $phone['id'];
                            }
                                
                            if(empty($resTel)){
                                $resPhone = $p_phone;
                            }else{
                                echo "Такой телефон уже существует!";
                                exit();
                            }
                            
                        }else{
                            $resPhone = $p_phone;
                        }
                    }else{
                        $resPhone = "none";
                    }
                        
                    $sql = $connect->prepare("UPDATE users SET fname = ?, lname = ?, email = ?, phone = ? WHERE unique_id = ?");
                    $sql->execute([$p_fname, $p_lname, $resEmail, $resPhone, $_SESSION['userUniqueId']]);
                        
                    getUserInfo($connect, $_SESSION['userUniqueId']);
                    
                    echo "Изменения сохранены!";
                }else{
                    echo "Введите почту!";
                }
            }else{
                echo "Введите имя!";
            }
        }
    }
    
    function changepasswordAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }else{
            
            $old_password = trim($_POST['old_password']);
            $new_password = trim($_POST['new_password']);
            
            if(!empty($old_password)){
                
                $sql = $connect->prepare("SELECT password FROM users WHERE unique_id = ?");
                $sql->execute([$_SESSION['userUniqueId']]);
                $info = $sql->fetchAll();
                            
                foreach($info as $pass){
                    $oldPassHash = $pass['password'];
                }
    
                if(password_verify($old_password, $oldPassHash)){
                    
                    if(!empty($new_password)){
                        
                        $newPasswordHash = password_hash($new_password, PASSWORD_DEFAULT);
                        
                        $sql = $connect->prepare("UPDATE users SET password = ? WHERE unique_id = ?");
                        $sql->execute([$newPasswordHash, $_SESSION['userUniqueId']]);
                        
                        echo "Пароль успешно изменен!";
                        
                    }else{
                        echo "Введите новый пароль!";
                    }
                    
                }else{
                    echo "Неверный пароль!";
                }
            
            }else{
                echo "Введите ваш пароль!";
            }
        }
        
    }
    
    function changeavatarAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }else{
            
            $avatar = $_FILES['avatar'];
            
            if(!empty($avatar['name'])){
                                                
                $img_name = $avatar['name'];
                $img_type = $avatar['type'];
                $tmp_name = $avatar['tmp_name'];
                                                
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);
                                
                $extensions = ["jpeg", "png", "jpg", "gif"];
                                                
                if(in_array($img_ext, $extensions) === true){
                                                    
                    $types = ["image/jpeg", "image/jpg", "image/png", "image/gif"];
                                                    
                    if(in_array($img_type, $types) === true){
                                                        
                        $time = time();
                        $new_img_name = $time.$img_name;
                                                        
                        if(move_uploaded_file($tmp_name, "img/avatars/".$new_img_name)){
                                                            
                            $sql = $connect->prepare("UPDATE users SET avatar = ? WHERE unique_id = ?");
                            $sql->execute([$new_img_name, $_SESSION['userUniqueId']]);
                            
                            getUserInfo($connect, $_SESSION['userUniqueId']);
                            
                            echo $new_img_name;
                                                        
                        }else{
                                                            
                            echo "Не удалось загрузить файл!";
                            
                        }
                                                        
                    }else{
                                                        
                        echo "Формат файла должен быть: jpeg, png, jpg, gif!";
                      
                    }
                                                    
                }else{
                                                    
                    echo "Формат файла должен быть: jpeg, png, jpg, gif!";
                           
                }
                    
            }
        }
    }
    
    function addaddresAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }else{
            $p_addres = htmlspecialchars(trim($_POST['addres']));
            
            if(!empty($p_addres)){
                $sql = $connect->prepare("UPDATE users SET addres = ? WHERE unique_id = ?");
                $sql->execute([$p_addres, $_SESSION['userUniqueId']]);
            }else{
                echo "Заполните все поля!";
            }
        }
    }
    
    function removeaddresAction($connect, $controllerName, $actionName, $user){
        
        if(!$user){
            Header("Location: /");
        }else{
            $sql = $connect->prepare("UPDATE users SET addres = '' WHERE unique_id = ?");
            $sql -> execute([$_SESSION['userUniqueId']]);
            echo "success";
        }
    }