# CONCEPTION ET IMPLEMETNATION D'UN SYSTEME DE GESTION DES VEHICULE D'UN GARAGE AUTOMOBILE

Ce projet vise à gérer les vehicules d'un garage automobile en associant chaque voiture à un client et à un garage

# Information sur les tables

## clients

- id
- last_name
- first_ame
- phone
- zip_code
- email

## garages

- id
- name
- address
- zip_code
- phone

## cars

- id
- mark
- model
- annee
- matricule
- client_id
- garage_id
- enterer_date
- out_date
