#!/bin/sh
base_dir=./docker/;

wpcms_help()
{
  mkdir -p ${base_dir}../wordpress/;
  mkdir -p ${base_dir}../db/;
  echo "";
  echo "Management options:";
  echo "";
  echo "--start-development                Create containers and start services";
  echo "--stop-development                 Stop services";
  echo "--remove-development               Remove containers";
  echo "--start-production                 Create stack services";
  echo "--stop-production                  Stop stack services";
  echo "--remove-networks      Remove networks";
  echo "";
  echo "If you want to show some container logs you can run:";
  echo "\$docker logs <container-name> -f --tail 100";
}

wpcms_start_development()
{
  echo "Starting development";
  echo "";
  docker-compose -f ${base_dir}docker-compose.yml -p wp-cms-development up -d;
  echo "";
  echo "Starting development finished";
}

wpcms_stop_development()
{
  echo "Stopping development";
  echo "";
  docker-compose -f ${base_dir}docker-compose.yml -p wp-cms-development stop;
  echo "";
  echo "Stopping development finished";
}

wpcms_remove_networks()
{
  echo "Removing all networks";
  echo "";
  docker network rm wp-cms-network;
  docker network rm wp-cms-development_default;
  docker network rm wp-cms-development_wordpress;
  docker network rm wp-cms-production_default;
  docker network rm wp-cms-production_wordpress;
  docker network rm production_default;
  sleep 6;
  echo "";
  echo "Removing all networks finished";
}

wpcms_remove_development()
{
  echo "Removing development";
  echo "";
  base_dir=./docker/;
  docker-compose -f ${base_dir}docker-compose.yml -p wp-cms-development down;
  wpcms_remove_networks;
  echo "";
  echo "Removing development finished";
}

wpcms_start_production()
{
  echo "Starting production";
  echo "";
  base_dir=./docker/;
  wpcms_remove_networks;
  docker stack deploy -c ${base_dir}docker-compose.yml wp-cms-production;
  echo "";
  echo "Starting production finished";
}

wpcms_stop_production()
{
  echo "Stopping production";
  echo "";
  docker stack rm wp-cms-production
  rcms_remove_networks;
  echo "";
  echo "Stopping production finished";
}


case $1 in
--start-development)
	wpcms_start_development;
	;;
--stop-development)
  wpcms_stop_development;
	;;
--remove-development)
	wpcms_remove_development;
	;;
--remove-networks)
  wpcms_remove_networks;
  ;;
--start-production)
	wpcms_start_production;
	;;
--stop-production)
	wpcms_stop_production;
	;;
--help)
  wpcms_help;
  ;;
*)
  wpcms_help;
  echo "";
  echo "Version. 1.0.0 beta";
  echo "";
	;;
esac

echo "== WORDPRESS CMS CLI ==";
