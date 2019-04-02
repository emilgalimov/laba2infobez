<?php

    

    

    main();
    function main(){
        $permissionKeys=['read','write','all','shareRights','none'];
        session_start();
        if (!isset($_SESSION['users'])){
        $_SESSION['users']=[
            1=>[
                'name'=>'Admin',
                'rights'=>[
                    'obj1'=>['all'],
                    'obj2'=>['all'],
                    'obj3'=>['all'],
                    'obj4'=>['all']
                ],
            ],
            2=>[
                'name'=>'User1',
                'rights'=>[
                    'obj1'=>['read','wright'],
                    'obj2'=>['none'],
                    'obj3'=>['read'],
                    'obj4'=>['shareRights']
                ],
            ],
            3=>[
                'name'=>'User2',
                'rights'=>[
                    'obj1'=>['all'],
                    'obj2'=>['read'],
                    'obj3'=>['write'],
                    'obj4'=>['read']
                ],
            ],
            4=>[
                'name'=>'User3',
                'rights'=>[
                    'obj1'=>['write'],
                    'obj2'=>['shareRights','write'],
                    'obj3'=>['write'],
                    'obj4'=>['none']
                ],
            ],
            5=>[
                'name'=>'Guest',
                'rights'=>[
                    'obj1'=>['read'],
                    'obj2'=>['none'],
                    'obj3'=>['none'],
                    'obj4'=>['none']
                ],
            ],

        ];
    }
        
        if(!$_GET){
            foreach($_SESSION['users'] as $id=>$user){
                echo('<a href=/?id='.$id.'>'.$user['name'].'</a></br>');
            }
        }else{
            if(!isset($_GET['file'])){
            $id=$_GET['id'];
            $user=$_SESSION['users'][$id];
            echo('<h1>'.$user['name'].'</h1>');
            foreach($user['rights'] as $obj => $rights){
                echo('<h2>'.$obj.'</h2>');
                if(!in_array('all',$rights)){
                foreach($rights as $right){
                echo('<a href=/?id='.$id.'&file='.$obj.'&task='.$right.'>'.$right.' </a></br>');
                }
            }else{
                foreach($permissionKeys as $right){
                    echo('<a href=/?id='.$id.'&file='.$obj.'&task='.$right.'>'.$right.' </a></br>');
                }
            }
            }
        }else{
            if($_GET['task']=='shareRights' && !isset($_GET['user'])){
                foreach($_SESSION['users'] as $key=>$user){
                    echo('<a href=/?id='.$_GET['id'].'&file='.$_GET['file'].'&task='.$_GET['task'].'&user='.$key.'>'.$user['name'].' </a></br>');
                }
            }else{
                $_SESSION['users'][$_GET['user']]['rights'][$_GET['file']]=$_SESSION['users'][$_GET['id']]['rights'][$_GET['file']];
            }
        }


        }
    


    }
