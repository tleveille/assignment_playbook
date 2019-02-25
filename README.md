

# Playbook structure

 	

~~~~
├── hosts
├── main.retry
├── main.yml
├── roles
│   ├── backends # COMMON CONFIG BACKEND SERVERS ONLY
│   │   ├── files
│   │   │   ├── client.php # renamed as index.php on the backend servers
│   │   │   ├── nginx_backend.conf # nginx config with connection to php-fpm
│   │   │   └── worker-php.service # the backend worker systemd unit file so that the process is restarted upon failure
│   │   ├── tasks
│   │   │   ├── main.yml
│   │   │   ├── nginx.yml
│   │   │   └── worker.yml
│   │   ├── templates
│   │   │   └── worker.php.j2      # the backend worker script file
│   │   └── vars
│   │       └── main.yml
│   ├── dbservers # SPECIFIC TO BACKEND2 MYSQL SERVER
│   │   ├── files
│   │   │   └── vworksdb.sql       # sql import file to create the records table
│   │   ├── tasks
│   │   │   └── main.yml           # create the db, users, and set firewall to only allow from both backend servers
│   │   └── vars
│   │       └── main.yml
│   ├── frontends # SPECIFIC TO THE LOADBALANCER Frontend
│   │   ├── files
│   │   │   └── nginx-loadbalancer.conf  # self explanatory
│   │   ├── tasks
│   │   │   └── main.yml
│   │   └── vars
│   │       └── main.yml
│   ├── gearmanservers # SPECIFIC TO THE BACKEND1 Gearman server
│   │   ├── files
│   │   │   └── gearman-job-server
│   │   ├── tasks
│   │   │   └── main.yml
│   │   └── vars
│   │       └── main.yml
│   └── common     # COMMON TO ALL MACHINES
│       ├── tasks
│       │   ├── fail2ban.yml  # self explanatory
│       │   ├── firewalld.yml # some common firewall rules (zone creations mainly)
│       │   ├── hosts.yml     # no DNS so we setup static hosts file to give friendly names to our machines
│       │   └── main.yml      # install nginx package and import the others files
│       └── vars
│           └── main.yml
└── vars
    └── dbsettings.yml # DB Settings, including password secret, not included in this repo.
 	

~~~~
