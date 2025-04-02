# KymaRoot
### v250402
Kyma Root è una applicazione web per la gestione di documenti aziendali realizzata in collaborazione con l'azienda Kyma Mobilità di Taranto.

> [!NOTE]
> Questo progetto è da intendersi come una risorsa didattica.

## Funzionalità
L'applicazione web prevede una interfaccia per la gestione, visualizzazione e indirizzamento dei documenti aziendali verso gli utenti autorizzati e interessati attraverso una bacheca documenti. Il sistema è organizzato in categorie utente e famiglie utente:
- **Categorie Utente**: sono predefinite di sistema e dunque non modificabili dall'interno, sono:
  - **Non Autorizzato**: è la categoria che viene assegnata automaticamente al momento della registrazione, gli utenti di questa categoria non saranno ne in grado di visualizzare i documenti presenti nella bacheca documenti, ne potranno accedere alle funzionalità di gestione utenti e documenti;
  - **Generico**: gli utenti di questa categoria saranno in grado di visualizzare i documenti nella bacheca documenti ma non potranno accedere alle funzionalità di gestione utenti e documenti
  - **Admin**: gli utenti di questa categoria hanno accesso a tutte le funzionalità del sistema, possono visualizzare i documenti nella bacheca documenti e possono usufruire delle funzionalità di gestione utenti e documenti, potendo modificare varie proprietà o eliminare questi ultimi.
- **Famiglie Utente**: il loro scopo è quello di identificare gli utenti in famiglie a cui sono indirizzati determinati documenti. Gli Utenti Admin possono creare nuove famiglie utente o modificarne di esistenti.

Gli Utenti Admin potranno aggiungere nuovi documenti inserendo le specifiche proprietá e un link di indirizzamento al documento su un cloud esterno.

> [!WARNING]
> La componente estetica é stata omessa in quanto inconclusa.

## Come accedere
Prima di incominciare ad utilizzare l'applicazione web é necessario inizializzare il Database tramite la Query presente nel file `database.sql` (MariaDB v10.0).  

Il Database prevede un utente Admin predefinito a cui é possibile accedere con le credenziali:
- Nome Utente: **admin**;
- Password: **admin**;

É necessario accedere a questo utente per impostare le categorie utente di altri eventuali utenti. É consigliato inoltre modificare la Password di quest'ultimo una volta effettuato l'accesso.
## Struttura del Database
![KR_Database_DiagramIMG](https://github.com/user-attachments/assets/628a8cf7-b94a-4474-b0cf-13cf910269a2)

## To Do
- [ ] Rendere possibile l'hosting del documento direttamente nel Database;
- [ ] Rendere non visibili i collegamenti alle pagine a cui un utente non é autorizzato;
- [ ] Implementare una funzione di ricerca nella bacheca documenti;
## Crediti
Realizzato dagli studenti del ITT A. Pacinotti di Taranto: Scarci Christian, Ferrara Vincenzo, Rizzi Raffaele, Latagliata Dario, Gigante Vincenzo, D'Andria Mattia
