CREATE TABLE `Users` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `type` VARCHAR(255),
  `username` VARCHAR(255),
  `password` VARCHAR(255),
  `email` VARCHAR(255),
  `address_id` integer
);

CREATE TABLE `Addresses` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `address` VARCHAR(255),
  `ward` VARCHAR(255),
  `district` VARCHAR(255),
  `city` VARCHAR(255)
);

CREATE TABLE `Companies` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `description` VARCHAR(255),
  `size` integer,
  `owner_id` integer
);

CREATE TABLE `Jobs` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255),
  `description` VARCHAR(255),
  `requirements` VARCHAR(255),
  `salary` VARCHAR(255),
  `expiration` date,
  `location` VARCHAR(255),
  `benefits` VARCHAR(255),
  `work_arrangement` VARCHAR(255),
  `levels` VARCHAR(255),
  `company_id` integer
);

CREATE TABLE `CVs` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `career_goal` VARCHAR(2048),
  `experiences` VARCHAR(2048),
  `highest_degree` VARCHAR(255),
  `current_position` VARCHAR(255),
  `skills` VARCHAR(255),
  `education` VARCHAR(2048),
  `languages` VARCHAR(255),
  `owner_id` integer,
  `willing_to_relocation` boolean,
  `location` VARCHAR(255),
  `desired_job_location` VARCHAR(255),
  `desired_job_salary` integer
);

CREATE TABLE `JobsCVs` (
  `job_id` integer,
  `cv_id` integer,
  PRIMARY KEY (`job_id`, `cv_id`)
);

ALTER TABLE `Companies` ADD FOREIGN KEY (`owner_id`) REFERENCES `Users` (`id`);

ALTER TABLE `JobsCVs` ADD FOREIGN KEY (`cv_id`) REFERENCES `CVs` (`id`);

ALTER TABLE `JobsCVs` ADD FOREIGN KEY (`job_id`) REFERENCES `Jobs` (`id`);

ALTER TABLE `Jobs` ADD FOREIGN KEY (`company_id`) REFERENCES `Companies` (`id`);

ALTER TABLE `CVs` ADD FOREIGN KEY (`owner_id`) REFERENCES `Users` (`id`);

ALTER TABLE `Users` ADD FOREIGN KEY (`address_id`) REFERENCES `Addresses` (`id`);
