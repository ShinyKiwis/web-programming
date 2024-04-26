CREATE TABLE `Users` (
  `id` integer PRIMARY KEY,
  `type` VARCHAR(255),
  `username` VARCHAR(255),
  `password` VARCHAR(255),
  `email` VARCHAR(255),
  `address_id` integer
);

CREATE TABLE `Addresses` (
  `id` integer PRIMARY KEY,
  `address` VARCHAR(255),
  `ward` VARCHAR(255),
  `district` VARCHAR(255),
  `city` VARCHAR(255)
);

CREATE TABLE `Companies` (
  `id` integer PRIMARY KEY,
  `name` VARCHAR(255),
  `description` VARCHAR(255),
  `size` integer,
  `contact_info` integer,
  `address_id` integer,
  `owner_id` integer
);

CREATE TABLE `Jobs` (
  `id` integer PRIMARY KEY,
  `name` VARCHAR(255),
  `description` VARCHAR(255),
  `requirements` VARCHAR(255),
  `salary` VARCHAR(255),
  `expiration` date,
  `location` VARCHAR(255),
  `benefits` VARCHAR(255),
  `company_id` integer
);

CREATE TABLE `JobsTags` (
  `job_id` integer,
  `tag_id` integer,
  PRIMARY KEY (`job_id`, `tag_id`)
);

CREATE TABLE `Tags` (
  `id` integer PRIMARY KEY,
  `name` VARCHAR(255)
);

CREATE TABLE `CVs` (
  `id` integer PRIMARY KEY,
  `career_goal` VARCHAR(255),
  `experiences` VARCHAR(255),
  `highest_degree` VARCHAR(255),
  `current_position` VARCHAR(255),
  `skills` VARCHAR(255),
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

CREATE TABLE `CVsExperiences` (
  `cv_id` integer,
  `experience_id` integer,
  PRIMARY KEY (`cv_id`, `experience_id`)
);

CREATE TABLE `Experiences` (
  `id` integer PRIMARY KEY,
  `position` VARCHAR(255),
  `company_id` integer,
  `startDate` date,
  `endDate` date,
  `description` VARCHAR(255),
  `company_name` VARCHAR(255),
  `type` VARCHAR(255)
);

ALTER TABLE `Companies` ADD FOREIGN KEY (`owner_id`) REFERENCES `Users` (`id`);

ALTER TABLE `JobsTags` ADD FOREIGN KEY (`job_id`) REFERENCES `Jobs` (`id`);

ALTER TABLE `JobsTags` ADD FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`id`);

ALTER TABLE `JobsCVs` ADD FOREIGN KEY (`cv_id`) REFERENCES `CVs` (`id`);

ALTER TABLE `JobsCVs` ADD FOREIGN KEY (`job_id`) REFERENCES `Jobs` (`id`);

ALTER TABLE `Jobs` ADD FOREIGN KEY (`company_id`) REFERENCES `Companies` (`id`);

ALTER TABLE `CVs` ADD FOREIGN KEY (`owner_id`) REFERENCES `Users` (`id`);

ALTER TABLE `CVsExperiences` ADD FOREIGN KEY (`cv_id`) REFERENCES `CVs` (`id`);

ALTER TABLE `CVsExperiences` ADD FOREIGN KEY (`experience_id`) REFERENCES `Experiences` (`id`);

ALTER TABLE `Experiences` ADD FOREIGN KEY (`company_id`) REFERENCES `Companies` (`id`);

ALTER TABLE `Users` ADD FOREIGN KEY (`address_id`) REFERENCES `Addresses` (`id`);

ALTER TABLE `Companies` ADD FOREIGN KEY (`address_id`) REFERENCES `Addresses` (`id`);
