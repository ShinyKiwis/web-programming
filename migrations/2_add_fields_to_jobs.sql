ALTER TABLE `Jobs`
ADD COLUMN `work_arrangement` VARCHAR(255) AFTER `benefits`,
ADD COLUMN `levels` VARCHAR(255) AFTER `work_arrangement`;
