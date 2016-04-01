    
    /*  SQL1 afiseaza toate modelele cu versiunile lor  */
    sql1 = SELECT M.Nume as Model, V.Nume as Versiune
           FROM versiune V JOIN model M ON V.IDModel = M.IDModel;
    
    /*  SQL2 afiseaza toate informatiile legate de caroserie pentru fiecare versiune in parte   */
    $sql2 = SELECT V.Nume, C.Lungime, C.Latime, C.Inaltime, C.Greutate, C.GreutateMaximaPermisa, C.Portbagaj, C.Rezervor
            FROM versiune V JOIN caroserie C ON V.IDCaroserie = C.IDCaroserie;
   
    /*  SQL3 afiseaza toate specificatiile tehnice ale motorului fiecarei versiuni, ordonate descrescator dupa putere*/
    $sql3 = SELECT V.Nume, M.TipMotor, M.NrCilindri, M.Putere, M.ConsumMixt, M.Volum, M.TipCutieViteze
            FROM versiune V JOIN motor M ON V.IDMotor = M.IDMotor
            ORDER BY M.Putere DESC;
    
    /*  SQL4 afiseaza numele si volum portbagajului pentru versiunile cu portbagaj mai voluminos de 400L*/
    $sql4 =  SELECT V.Nume, C.Portbagaj
             FROM versiune V JOIN caroserie C ON V.IDCaroserie = C.IDCaroserie
             WHERE C.Portbagaj > 400;      
   
    /*  SQL5 afiseaza numele versiunilor si modelelor din care fac parte cu cele mai mici 3 consumuri mixte distincte*/
    $sql5 = SELECT Md.Nume as Model, V.Nume as Versiune, M.ConsumMixt
            FROM versiune V JOIN model Md ON V.IDModel = Md.IDModel 
            JOIN motor M ON V.IDMotor = M.IDMotor
            WHERE 4> (SELECT COUNT(*)
                      FROM motor
                      WHERE M.ConsumMixt > ConsumMixt)
            ORDER BY M.ConsumMixt;      
    
    /*  SQL6 afiseaza numele si modelul tuturor versiunilor cu performantele aferente*/
    $sql6 = SELECT Md.Nume as Model, V.Nume as Versiune, P.Acceleratie100, P.VitezaMaxima, P.Acceleratie160
            FROM versiune V JOIN model Md ON V.IDModel = Md.IDModel 
            JOIN performante P ON V.IDPerformanta = P.IDPerformanta;
    
    /*  SQL7 afiseaza versiunile cu cea mai mare acceleratie 0-100km/h din fiecare model (cel mai mic nr de secunde) */
    $sql7 = SELECT Md.Nume as Model, V.Nume as Versiune, P.Acceleratie100
            FROM versiune V JOIN model Md ON V.IDModel = Md.IDModel 
            JOIN performante P ON V.IDPerformanta = P.IDPerformanta
            WHERE P.Acceleratie100 = 
                        (SELECT MIN(P2.Acceleratie100)
                         FROM performante P2 JOIN versiune V2 ON V2.IDPerformanta = P2.IDPerformanta
                         JOIN model Md2 ON V2.IDModel = Md2.IDModel 
                         WHERE Md2.Nume = Md.Nume)
            GROUP BY Md.Nume;
   
    /*  SQL8 afiseaza versiunile care au extraoptiuni din categoria "Comfort" */
    $sql8 = SELECT V.Nume
            FROM versiune V JOIN areextraoptiune A ON V.IDVersiune = A.IDVersiune
            WHERE A.IDExtraOptiune IN 
                    (SELECT IDExtraOptiune
                     FROM extraoptiuni
                     WHERE Categorie LIKE 'Comfort');
    
    /*  SQL9 afiseaza toate extraoptiunile din categoria "Siguranta" */
    $sql9 = SELECT NumeOptiune
            FROM extraoptiuni
            WHERE Categorie Like 'Siguranta';
    
    /*  SQL10 afiseaza versiunile si modelele din care fac parte, versiuni ce au disponibile cele mai multe extraoptiuni */
    $sql10 = SELECT M.Nume as Model, V.Nume as Versiune, COUNT(A.IDExtraOptiune) as NrOptiuni
             FROM model M JOIN versiune V ON M.IDModel = V.IDModel 
             JOIN areextraoptiune A ON A.IDVersiune = V.IDVersiune
             GROUP BY V.Nume
             HAVING COUNT(A.IDExtraOptiune) = 
                    (SELECT MAX(S.NrOpt)
                     FROM 
                            (SELECT COUNT(IDExtraOptiune) as NrOpt
                             FROM areextraoptiune AR JOIN versiune VR ON AR.IDVersiune = VR.IDVersiune
                             GROUP BY VR.Nume) 
                     as S);
    /*  SQL11 afiseaza toate specificatiile tehnice pentru o versiune a unui model aleasa dinamic de utilizatorul aplicatiei */               
    $sql11 = SELECT V.Nume,Mot.TipMotor,Mot.NrCilindri,Mot.Putere,Mot.ConsumMixt,Mot.Volum,Mot.TipCutieViteze,C.Lungime,C.Latime,C.Inaltime,C.Greutate,C.GreutateMaximaPermisa,C.Portbagaj,C.Rezervor,P.Acceleratie100,P.VitezaMaxima
             FROM model M JOIN versiune V ON M.IDVersiune = V.IDVersiune 
             JOIN motor Mot ON V.IDMotor = Mot.IDMotor 
             JOIN caroserie ON V.IDCaroserie = C.IDCaroserie
             JOIN performante ON V.IDPerformante = P.IDPerformante
             WHERE V.Nume = $_POST['search'];
   