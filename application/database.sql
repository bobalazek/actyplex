DROP TABLE IF EXISTS `entries`;
CREATE TABLE `entries` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    
    `user_id` INT(11) UNSIGNED NOT NULL,
    
    `time_from` DATETIME NOT NULL,
    `time_to` DATETIME NOT NULL,
    
    `type` VARCHAR(32) NOT NULL, -- What's the type of the entry? measurement, symptom, medication, food, disease, activity, event, other
    
    -- Types
    -- measurement
    `measurement_height` TINYINT(3) UNSIGNED NOT NULL,
    `measurement_weight` TINYINT(3) UNSIGNED NOT NULL,
    `measurement_systolic_blood_pressure` TINYINT(3) UNSIGNED NOT NULL,
    `measurement_diastolic_blood_pressure` TINYINT(3) UNSIGNED NOT NULL,
    `measurement_pulse` TINYINT(3) UNSIGNED NOT NULL,
    `measurement_fever` DECIMAL(4,1) UNSIGNED NOT NULL,
    -- symptom
    `symptom_what` VARCHAR(255) NOT NULL, -- what is the symptom
    `symptom_pain_intensity` VARCHAR(255) NOT NULL,
    `symptom_where` VARCHAR(255) NOT NULL, -- To describe it more precisely
    -- medication
    `medication_what` VARCHAR(255) NOT NULL, -- What have we took?
    `medication_how_much` VARCHAR(255) NOT NULL, -- How much of it?
    -- activity
    `activity_what` VARCHAR(255) NOT NULL, -- What have we done?
    `activity_intensity` VARCHAR(255) NOT NULL, -- Did we only "trained" easy or exteme, or something in between?
    `activity_calories_burned` INT(11) NOT NULL,
    -- food
    `food_what` VARCHAR(255) NOT NULL, -- What have we ate?
    `food_how_much` VARCHAR(255) NOT NULL,
    `food_calories` INT(11) NOT NULL, -- How much it has?
    -- disease
    `disease_what` VARCHAR(255) NOT NULL, -- Any disease we have?
    `disease_symptoms` TEXT NOT NULL, -- What are/were our symptoms?
    `disease_self_diagnosed` TINYINT(1) NOT NULL, -- Do we diagnosed it by ourselves?
    `disease_ongoing` TINYINT(1) NOT NULL, -- Chronic and stuff?
    -- event
    `event_what` VARCHAR(255) NOT NULL, -- Party or what? Visit by the doctor?
    `event_details` TEXT NOT NULL, -- Tell me more about it.
    -- other
    `other_what` VARCHAR(255) NOT NULL,
    
    `mood` TEXT NOT NULL, -- How do we feel right now?
    `note` TEXT NOT NULL, -- Do we have any other infos for the entry?
    `privacy` VARCHAR(8) NOT NULL, -- Who can see the entry? me,doctor,public
    
    `time_created` DATETIME NOT NULL, -- When was the entry made?
    
    PRIMARY KEY `id` (`id`),
    KEY `user_id` (`user_id`)
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    
    `parent_user_id` INT(11) UNSIGNED NOT NULL DEFAULT 0, -- Is the user a child, controlled by a parent?
    `doctor_user_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
    
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`activation_code` VARCHAR(64) NOT NULL,
	`activated` TINYINT(1) NOT NULL DEFAULT 0,
	
	`language` VARCHAR(2) NOT NULL, -- like 'en'
	`locale` VARCHAR(8) NOT NULL, -- like 'en_US'
	`country` VARCHAR(8) NOT NULL, -- like 'us'
	`system` VARCHAR(8) NOT NULL DEFAULT 'metric', -- metric/imperial
	
	`first_name` VARCHAR(255) NOT NULL,
	`last_name` VARCHAR(255) NOT NULL,
	`gender` VARCHAR(8) NOT NULL,
	`address` VARCHAR(255) NOT NULL,
	`city` VARCHAR(255) NOT NULL,
	`country` VARCHAR(32) NOT NULL,
	
	`type` VARCHAR(16) NOT NULL DEFAULT 'patient',
	
	`birthday` DATE NOT NULL,
	
	`user_agent` TEXT NOT NULL,
	`ip` VARCHAR(255) NOT NULL,
    
    `time_created` DATETIME NOT NULL, -- When was the entry made?
    
	PRIMARY KEY `id` (`id`),
	KEY `parent_user_id` (`parent_user_id`),
	KEY `doctor_user_id` (`doctor_user_id`)
);