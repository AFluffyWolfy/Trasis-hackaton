# INSTRUCTIONS

## PREREQUISITES
To use this web app you must be connected on the helmo network and download filezilla.

## INSTALLATION
To use the solution you need to deploy it on the Dartagnan server.
- First you need to clone the solution on a computer by using the commande ```git clone https://git.cg.helmo.be/q210187/TRASIS_PROJECT.git``` in the git bash
- Then you need to open filezilla and connect to the Dartagnan server with your helmo credentials.
- Then you need to open the solution directory and drag and drop it in the racine directory of your Dartagnan session.
- When it's done you can view the application by type the following url 192.168.128.13/~[e123456] (replace [e123456] by your helmo matricule)
- Now you can use the solution and enjoy it

## The implemented functionnalities
- Add users and a function for them
- Authentification (the password is hashed with BCRYPT)
- Archiving users
- Display of the ongoing trainings

## Problem encountered that could not be corrected: 
- Adding of multiple function for a user
- The sending of a mail after the creation of a user
- For some reason only the account of the user georgette@myemail.com can log in, we couldn't find why because of the time we had to develop.