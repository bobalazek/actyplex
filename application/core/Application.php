<?php

include APPLICATION_PATH . 'thirdPartyLibraries/facebook-sdk/src/facebook.php';

class Application
{
	public $language = 'en';
	
    public $pdo = null;
    public $router = null;
    
    public $userId = 0;
    public $userProfile = null;
    public $userChildren = array();
    
    public function __construct()
    {
    	$this->language = getLanguage();
    	
        $this->pdo = new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME, DATABASE_USERNAME, DATABASE_PASSWORD);
        global $router;
        $this->router = $router;
        
        $this->userProfile = new stdClass();
        $this->userProfile->type = 'guest';
		
		if( isset( $_COOKIE['user_id'] ) )
		{
			$id = $_COOKIE['user_id'];

	    	$sql = "SELECT * FROM users WHERE `id`=:id LIMIT 1";
	        $query = $this->pdo->prepare($sql);
	    			
	    	$query->bindValue(':id', $id);
	        
			$query->execute();
			
			$user = $query->fetch(PDO::FETCH_OBJ);
			
			if( $user != false )
			{
				$this->userId = $user->id;
				$this->userProfile = $user;
				$this->userProfile->name = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
				$birthday = strtotime($this->userProfile->birthday);  
				$this->userProfile->age = date('md', $birthday) > date('md') ? date('Y') - date('Y', $birthday) - 1 : date('Y') - date('Y', $birthday);
				$this->setUserChildren();
				// TO-DO..
				// Current stuff (what's the current height, weight) to particular date...
			}
			else
			{
				setcookie('user_id', '', time() - 3600, '/'); // TO-DO..set the path right
			}
		}
    }
    
    /***** Profile stuff *****/
    public function setUserChildren()
    {
	    	$sql = "SELECT * FROM users WHERE `parent_user_id`=:parent_user_id ORDER BY birthday ASC";
	        $query = $this->pdo->prepare($sql);
	    			
	    	$query->bindValue(':parent_user_id', $this->userId);
	        
			$query->execute();
			
			$children = $query->fetchAll(PDO::FETCH_OBJ);
			
			if( !empty( $children ) ) $this->userChildren = $children;
    }
    
    public function parentsChild( $childId = 0 )
    {
			$childReturn = false;
			
			foreach( $this->userChildren as $child )
			{
				if( $childId == $child->id )
				{
					$childReturn = $child;
					$childReturn->name = ucfirst($child->first_name) . ' ' . ucfirst($child->last_name); // edited this before connection broke! save again!!!
					$birthday = strtotime($childReturn->birthday);  
					$childReturn->age = date('md', $birthday) > date('md') ? date('Y') - date('Y', $birthday) - 1 : date('Y') - date('Y', $birthday);
				}
			}
			
			return $childReturn;
    }
    
    /***** Template stuff *****/
    public function showPage()
    {
    	global $router;
    	
		$page = $router->fragment(0);
		
		if( $page == false ) $page = 'index';
		
		$path = APPLICATION_PATH . 'templates/pages/' . $page . '/template.php';
		
		if( file_exists( $path ) )
		{
			include $path;
		}
		else
		{
			include APPLICATION_PATH . 'templates/pages/404/template.php';	
		}
    }
    
    /***** Authorization *****/
    public function uniqueEmail()
    {
    	$data = $_GET;
    	
    	$email = isset ($data['email'] ) ? $data['email'] : '';
    	
    	$response = true;
    	
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        
        $queryResponse = $query->fetch();
        
    	if( $queryResponse === false ) $response = false;
    	
    	return !$response ? 'true' : false; // Make it inverse
    }
    
    public function signUp()
    {
        $data = $_GET;
        
    	$firstName = $data['first_name'];
    	$lastName = $data['last_name'];
    	$email = $data['email'];
    	$password = hash('md5', $data['password']);
    	$gender = $data['gender'];
    	$birthday = $data['birthday'];
    	$userAgent = $_SERVER['HTTP_USER_AGENT'];
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$timeCreated = date("Y-m-d H:i:s");
    	$language = $this->language;
    	$locale = $_SERVER['HTTP_USER_AGENT'];
    	
    	$sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `password`, `gender`, `birthday`, `user_agent`, `ip`, 
    				`time_created`, `language`, `locale`) 
    			VALUES (:first_name, :last_name, :email, :password, :gender, :birthday, :user_agent, :ip, 
    				:time_created, :language, :locale)";
        $query = $this->pdo->prepare($sql);
    			
    	$query->bindValue(':first_name', $firstName);
    	$query->bindValue(':last_name', $lastName);
    	$query->bindValue(':email', $email);
    	$query->bindValue(':password', $password);
    	$query->bindValue(':gender', $gender);
    	$query->bindValue(':birthday', $birthday);
    	$query->bindValue(':user_agent', $userAgent);
    	$query->bindValue(':ip', $ip);
    	$query->bindValue(':time_created', $timeCreated);
    	$query->bindValue(':language', $language);
    	$query->bindValue(':locale', $locale);
        
		return $query->execute();
    }
    
    public function signIn()
    {
    	$data = $_GET;
    	
    	$email = $data['email'];
    	$password = hash('md5', $data['password']);
    	
    	$sql = "SELECT * FROM users WHERE `email`=:email AND `password`=:password LIMIT 1";
        $query = $this->pdo->prepare($sql);
    			
    	$query->bindValue(':email', $email);
    	$query->bindValue(':password', $password);
        
		$query->execute();
		
		$result = $query->fetch(PDO::FETCH_OBJ);

		if( $result !== false )
		{
			setcookie('user_id', $result->id, time() + (3600 * 24 * 30 * 12), '/'); // TO-DO..set the path right
			return true;
		}
		else
		{
			return false;
		}
    }
    
    public function signOut()
    {
    	setcookie('user_id', '', time() - 3600, '/'); // TO-DO..set the path right
    }
    
    /***** Entries *****/
    public function getEntries()
    {
    	$data = $_GET;
		$filterType = isset( $data['filter_type'] ) ? $data['filter_type'] : '';
		$userId = $this->userId;
		
		// When  we are on childs entry site..show the child entries!
    	$childId = isset( $data['child_id'] ) && $data['child_id'] != '0' ? $data['child_id'] : 0;
    	$parentChild = $this->parentsChild($childId);
        if( $childId != 0 && $parentChild != false ) $userId = $childId;
    	
        $additionalSql = '';
        
        if( $filterType != '' ) $additionalSql = "AND type='" . $filterType . "'";
        
        $sql = "SELECT * FROM entries WHERE user_id=$userId $additionalSql ORDER BY time_from DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function getEntry()
    {
        $data = $_GET;
        
        $id = $data['id'];
        $userId  = $this->userId;
        
		// When  we are on childs entry site..show the child entries!
    	$childId = isset( $data['child_id'] ) && $data['child_id'] != '0' ? $data['child_id'] : 0;
    	$parentChild = $this->parentsChild($childId);
        if( $childId != 0 && $parentChild != false ) $userId = $childId;
        unset($data['child_id']);
        
        $sql = "SELECT * FROM entries WHERE id=$id AND user_id=$userId LIMIT 1";
        $query = $this->pdo->query($sql);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function addEntry()
    {
        $data = $_GET;
        
        $data['user_id'] = $this->userId;
        $data['time_created'] = date("Y-m-d H:i:s");
        
		// When  we are on childs entry site..show the child entries!
    	$childId = isset( $data['child_id'] ) && $data['child_id'] != '0' ? $data['child_id'] : 0;
    	$parentChild = $this->parentsChild($childId);
        if( $childId != 0 && $parentChild != false ) $data['user_id'] = $childId;
        unset($data['child_id']);
        
        $keys = array_keys( $data );
        
        $keysSql = array_map( function($val) {
            return '`' . $val . '`';
        }, $keys);
        $keysSql = implode(', ', $keysSql);
        
        $valuesSql = array_map( function($val) {
            return ':' . $val;
        }, $keys);
        $valuesSql = implode(', ', $valuesSql);
        
        $sql = "INSERT INTO entries ($keysSql) VALUES ($valuesSql)";
        $query = $this->pdo->prepare($sql);
        
        foreach( $data as $key => $val )
        {
        	if( $key == 'disease_self_diagnosed' || $key == 'disease_ongoing' )
        	{
        		if( isset( $val ) ) $val = 1;
        	}
        	
            $query->bindValue(':' . $key, htmlspecialchars($val));
        }
        
		return $query->execute();
    }
    
    public function editEntry()
    {
    	$data = array();
        $data['disease_self_diagnosed'] = ''; // set the two, before we get the array from get!
        $data['disease_ongoing'] = '';
        $data = array_merge($data, $_GET);
        
        $data['user_id'] = $this->userId;
        $userId  = $this->userId;
        
        var_dump($data);
        
		// When  we are on childs entry site..show the child entries!
    	$childId = isset( $data['child_id'] ) && $data['child_id'] != '0' ? $data['child_id'] : 0;
    	$parentChild = $this->parentsChild($childId);
        if( $childId != 0 && $parentChild != false ) 
        {
        	$userId = $childId;
        	$data['user_id'] = $childId;
        }
        unset($data['child_id']);
        
        $id = $data['id'];
        
        $setSqlArray = array();
        
        foreach( $data as $key => $value )
        {
        	$setSqlArray[] = "`$key`=:$key";
        }
        
        $setSql = implode(', ', $setSqlArray);
        
        $sql = "UPDATE entries SET $setSql WHERE id=$id AND user_id=$userId";
        
        $query = $this->pdo->prepare($sql);
		
        foreach( $data as $key => $val )
        {
        	if( $key == 'disease_self_diagnosed' || $key == 'disease_ongoing' )
        	{
        		if( $val == 'on' ) $val = 1;
        	}

            $query->bindValue(':' . $key, htmlspecialchars($val));
        }
        
        return $query->execute();
    }
    
    public function removeEntry()
    {
        $data = $_GET;
        
        $data['user_id'] = $this->userId;
        $userId  = $this->userId;
        
		// When  we are on childs entry site..show the child entries!
    	$childId = isset( $data['child_id'] ) && $data['child_id'] != '0' ? $data['child_id'] : 0;
    	$parentChild = $this->parentsChild($childId);
        if( $childId != 0 && $parentChild != false ) 
        {
        	$userId = $childId;
        	$data['user_id'] = $childId;
        }
        unset($data['child_id']);
        
        $id = $data['id'];
        
        $sql = "DELETE FROM entries WHERE id=$id AND user_id=$userId";
        $query = $this->pdo->prepare($sql);
        
        return $query->execute();
    }
    
    /***** Childs *****/
    public function getChild()
    {
        $data = $_GET;
        
        $id = $data['id'];
        $parentUserId  = $this->userId;
        
        $sql = "SELECT * FROM users WHERE id=$id AND parent_user_id=$parentUserId LIMIT 1";
        $query = $this->pdo->query($sql);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function editChild()
    {
        $data = $_GET;
        
        $id = $data['id'];
        $parentUserId = $this->userId;
        
        $setSqlArray = array();
        
        foreach( $data as $key => $value )
        {
        	$setSqlArray[] = "`$key`=:$key";
        }
        
        $setSql = implode(', ', $setSqlArray);
        
        $sql = "UPDATE users SET $setSql WHERE id=$id AND parent_user_id=$parentUserId";
        
        $query = $this->pdo->prepare($sql);
        
        foreach( $data as $key1 => $val1 )
        {
            $query->bindValue(':' . $key1, htmlspecialchars($val1));
        }
        
        return $query->execute();
    }
    
    public function removeChild()
    {
        $data = $_GET;
        
        $id = $data['id'];
        $parentUserId  = $this->userId;
        
        $sql = "DELETE FROM users WHERE id=$id AND parent_user_id=$parentUserId";
        $query = $this->pdo->prepare($sql);
        
        return $query->execute();
    }
    
    public function addAChild()
    {
        $data = $_GET;
        
    	$firstName = $data['first_name'];
    	$lastName = $data['last_name'];
    	$gender = $data['gender'];;
    	$birthday = $data['birthday'];;
    	$userAgent = $_SERVER['HTTP_USER_AGENT'];
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$timeCreated = date("Y-m-d H:i:s");
    	$parentUserId = $this->userId;
    	
    	$sql = "INSERT INTO users (`first_name`, `last_name`, `gender`, `birthday`, `user_agent`, `ip`, `parent_user_id`, `time_created`) 
    			VALUES (:first_name, :last_name, :gender,:birthday, :user_agent, :ip, :parent_user_id, :time_created)";
        $query = $this->pdo->prepare($sql);
    			    	
    	$query->bindValue(':first_name', $firstName);
    	$query->bindValue(':last_name', $lastName);
    	$query->bindValue(':gender', $gender);
    	$query->bindValue(':birthday', $birthday);
    	$query->bindValue(':user_agent', $userAgent);
    	$query->bindValue(':ip', $ip);
    	$query->bindValue(':parent_user_id', $parentUserId);
    	$query->bindValue(':time_created', $timeCreated);
        
		return $query->execute();
    }
    
    public function getEntriesHtml()
    {
		$output = '';
		
		$entries = $this->getEntries();
		
        if( $entries )
        {
            foreach( $entries as $entry )
            {
                $output .= '<tr id="entry-id-' . $entry->id . '" data-id="' . $entry->id . '">';
                    $output .= '<td>';
                        $output .= date("d.m.Y H:i:s", strtotime($entry->time_from));
                        if( $entry->time_to != '0000-00-00 00:00:00' )
                        {
                            $output .= ' => ' . date("d.m.Y H:i:s", strtotime($entry->time_to));
                        }
                    $output .= '</td>';
                    $output .= '<td>';
                        $output .= __( ucfirst( $entry->type ) );
                    $output .= '</td>';
                    $output .= '<td>';
                        if( $entry->type == 'measurement' )
                        {
                            if( $entry->measurement_height != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Height') . ':</b>';
                                    $output .= ' <span class="measurement-height">' . $entry->measurement_height . '</span>';
                                    $output .= 'cm';
                                $output .= '</div>';
                            }
                            if( $entry->measurement_weight != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Weight') . ':</b>';
                                    $output .= ' <span class="measurement-weight">' . $entry->measurement_weight . '</span>';
                                    $output .= 'kg';
                                $output .= '</div>';
                            }
                            if( $entry->measurement_height != 0 && $entry->measurement_weight != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('BMI') . ':</b>';
                                    $output .= ' <span class="measurement-bmi">';
                                        $output .= round( $entry->measurement_weight / ( ( $entry->measurement_height / 100 ) * ( $entry->measurement_height / 100 ) ), 1 );
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->measurement_systolic_blood_pressure != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Systolic Blood Pressure') . ':</b>';
                                    $output .= ' <span class="measurement-systolic-blood-pressure">';
                                        $output .= $entry->measurement_systolic_blood_pressure;
                                    $output .= '</span>';
                                    $output .= 'mm Hg';
                                $output .= '</div>';
                            }
                            if( $entry->measurement_diastolic_blood_pressure != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Diastolic Blood Pressure') . ':</b>';
                                    $output .= ' <span class="measurement-diastolic-blood-pressure">';
                                        $output .= $entry->measurement_diastolic_blood_pressure;
                                    $output .= '</span>';
                                    $output .= 'mm Hg';
                                $output .= '</div>';
                            }
                            if( $entry->measurement_pulse != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Pulse') . ':</b>';
                                    $output .= ' <span class="measurement-pulse">';
                                        $output .= $entry->measurement_pulse;
                                    $output .= '</span>';
                                    $output .=  __('bpm');
                                $output .= '</div>';
                            }
                            if( $entry->measurement_fever != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Fever') . ':</b>';
                                    $output .= ' <span class="measurement-fever">';
                                        $output .= $entry->measurement_fever;
                                    $output .= '</span>';
                                    $output .= '°C';
                                $output .= '</div>';
                            }
                        }
                        elseif( $entry->type == 'symptom' )
                        {
                            if( $entry->symptom_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="symptom-what">';
                                        $output .= $entry->symptom_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->symptom_pain_intensity != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Pain intensity') . ':</b>';
                                    $output .= ' <span class="symptom-pain-intensity">';
                                        $output .= $entry->symptom_pain_intensity;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->symptom_where != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Where') . ':</b>';
                                    $output .= ' <span class="symptom-where">';
                                        $output .= $entry->symptom_where;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                        }
                        elseif( $entry->type == 'medication' )
                        {
                            if( $entry->medication_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="medication-what">';
                                        $output .= $entry->medication_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->medication_how_much != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('How much') . ':</b>';
                                    $output .= ' <span class="symptom-pain">';
                                        $output .= $entry->medication_how_much;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                        }
                        elseif( $entry->type == 'activity' )
                        {
                            if( $entry->activity_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="activity-what">';
                                        $output .= $entry->activity_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->activity_intensity != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Intensity') . ':</b>';
                                    $output .= ' <span class="activity-intensity">';
                                        $output .= $entry->activity_intensity;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->activity_calories_burned != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Calories burned') . ':</b>';
                                    $output .= ' <span class="activity-calories-burned">';
                                        $output .= $entry->activity_calories_burned;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                        }
                        elseif( $entry->type == 'food' )
                        {
                            if( $entry->food_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="food-what">';
                                        $output .= $entry->food_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->food_how_much != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('How much') . ':</b>';
                                    $output .= ' <span class="food-how-much">';
                                        $output .= $entry->food_how_much;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->food_calories != 0 )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Calories') . ':</b>';
                                    $output .= ' <span class="food-calories">';
                                        $output .= $entry->food_calories;
                                    $output .= '</span>';
                                    $output .= 'kcal';
                                $output .= '</div>';
                            }
                        }
                        elseif( $entry->type == 'disease' )
                        {
                            if( $entry->disease_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="disease-what">';
                                        $output .= $entry->disease_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->disease_symptoms != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Symptoms') . ':</b>';
                                    $output .= ' <span class="disease-symptoms">';
                                        $output .= $entry->disease_symptoms;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            $output .= '<div>';
                                $output .= '<b>' . __('Self diagnosed') . ':</b>';
                                $output .= ' <span class="disease-self-diagnosed">';
                                    $output .= $entry->disease_self_diagnosed ? __('Yes') : __('No, the doctor did');
                                $output .= '</span>';
                            $output .= '</div>';
                            $output .= '<div>';
                                $output .= '<b>' . __('Ongoing') . ':</b>';
                                $output .= ' <span class="disease-ongoing">';
                                    $output .= $entry->disease_ongoing ? __('Yes') : __('No');
                                $output .= '</span>';
                            $output .= '</div>';
                        }
                        elseif( $entry->type == 'event' )
                        {
                            if( $entry->event_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="event-what">';
                                       $output .= $entry->event_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                            if( $entry->event_details != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('Details') . ':</b>';
                                    $output .= ' <span class="event-details">';
                                    	$output .= $entry->event_details;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                        }
                        elseif( $entry->type == 'other' )
                        {
                            if( $entry->other_what != '' )
                            {
                                $output .= '<div>';
                                    $output .= '<b>' . __('What') . ':</b>';
                                    $output .= ' <span class="other-what">';
                                        $output .= $entry->other_what;
                                    $output .= '</span>';
                                $output .= '</div>';
                            }
                        }
                    $output .= '</td>';
                    $output .= '<td>';
                        if( $entry->mood != '' )
                        {
                            $output .= '<div>';
                                $output .= '<b>' . __('Mood') . ':</b>';
                                $output .= ' <span class="mood">';
                                    $output .= $entry->mood;
                                $output .= '</span>';
                            $output .= '</div>';
                        }
                        if( $entry->note != '' )
                        {
                            $output .= '<div>';
                                $output .= '<b>' . __('Note') . ':</b>';
                                $output .= ' <span class="note">';
                                    $output .= $entry->note;
                                $output .= '</span>';
                            $output .= '</div>';
                        }
                    $output .= '</td>';
                    $output .= '<td>';
                        $output .= '<ul class="button-group">';
                            $output .= '<li>';
                                $output .= '<button class="edit-entry-button  small button">';
                                    $output .= '<i class="general foundicon-edit"></i>';
                                    $output .= __('Edit');
                                $output .= '</button>';
                            $output .= '</li>';
                            $output .= '<li>';
                                $output .= '<button class="remove-entry-button  small button alert">';
                                    $output .= '<i class="general foundicon-remove"></i>';
                                    $output .= __('Remove');
                                $output .= '</button>';
                            $output .= '</li>';
                        $output .= '</ul>';
                    $output .= '</td>';
                $output .= '</tr>';
            }
        }
        else
        {
            $output .= '<tr>';
                $output .= '<td class="no-entries-added" colspan="5">' . __('We do not have any entries from you yet') . '!</td>';
            $output .= '</tr>';
        }
		
		return $output;
    }
    
    public function getChildrenHtml()
    {
		$output = '';
		
		$children = $this->userChildren;
		
        if( $children )
        {
            foreach( $children as $child )
            {
                $output .= '<tr id="child-id-' . $child->id . '" data-id="' . $child->id . '">';
                    $output .= '<td>';
						$output .= $child->first_name;
                    $output .= '</td>';
                    $output .= '<td>';
						$output .= $child->last_name;
                    $output .= '</td>';
                    $output .= '<td>';
						$output .= $child->gender == 'male' ? __('Male') : __('Female');
                    $output .= '</td>';
                    $output .= '<td>';
						$output .= date("d.m.Y", strtotime($child->birthday));
                    $output .= '</td>';
                    $output .= '<td>';
                        $output .= '<ul class="button-group">';
                            $output .= '<li>';
                                $output .= '<a href="' . BASE_URL . 'entries/' . $child->id . '" class="small button secondary">';
                                    $output .= '<i class="general foundicon-add-doc"></i>';
                                    $output .= __('Entries');
                                $output .= '</a>';
                            $output .= '</li>';
                            $output .= '<li>';
                                $output .= '<button class="edit-child-button  small button">';
                                    $output .= '<i class="general foundicon-edit"></i>';
                                    $output .= __('Edit');
                                $output .= '</button>';
                            $output .= '</li>';
                            $output .= '<li>';
                                $output .= '<button class="remove-child-button  small button alert">';
                                    $output .= '<i class="general foundicon-remove"></i>';
                                    $output .= __('Remove');
                                $output .= '</button>';
                            $output .= '</li>';
                        $output .= '</ul>';
                    $output .= '</td>';
                $output .= '</tr>';
            }
        }
        else
        {
            $output .= '<tr>';
                $output .= '<td class="no-children-added" colspan="5">' . __('You do not have added any children yet') . '!</td>';
            $output .= '</tr>';
        }
		
		return $output;
    }
}