<?php
                // messages
                function msgSeesion($msg){
                    if(isset($_SESSION[$msg])){
                        foreach($_SESSION[$msg] as $value){
                            echo "
                            <div class=\"alert alert-$msg p-1 m-1 text-center \" role=\"alert\">"
                             .$value .
                           " </div>
                            ";
                        }
                    unset($_SESSION[$msg]);
                    }
                }

                // session of username
                function UserName($user){
                    if(isset($_SESSION[$user])){
                       $username= $_SESSION[$user];
                    }
                    return $username;
                }