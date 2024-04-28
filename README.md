# Work Seekers
## Prerequisite 
- Docker
- Python 

## Adminer
To run adminer use following credentials:
- Server: mysql
- Username: developer
- Password: developer
- Database: work_seekers

## How to generate a controller ?
Simply runs: `python generator.py [controller_name_in_plurals]`

## How to run ?
1. Simply runs `docker compose -p work_seekers up`
2. Access the website at `http://localhost:8080`

# How to setup database ?
1. Simply try to run `scripts.sql` in `Adminer`
2. Access the Adminer at `http://localhost:8081`
3. Login with credentials at Adminer section above
