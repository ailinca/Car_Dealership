<form action="motor-insert.php" method="post">
	Tip Motor:
        <select name="TipMotor">
            <option value="benzina">benzina</option>
            <option value="diesel">diesel</option>
        </select><br>
        Numar Cilindri: 
	<input type="number" name="NrCilindri"><br>
	Putere: 
	<input type="number" name="Putere"><br>
	Consum Mixt: 
	<input type="number" step="0.1" min="0" name="ConsumMixt"><br>
	Emisii CO2: 
	<input type="number" name="EmisiiCO2"><br>
	Volum: 
	<input type="number" name="Volum"><br>
	Tip Cutie Viteze: 
	<select name="TipCutieViteze">
            <option value="manuala">manuala</option>
            <option value="automata">automata</option>
        </select><br>
	<input type="Submit" value="Submit">
</form>
