<h1>Adicionar Despesa</h1>

<form method="POST" action="adicionar_action.php">
  <label for="D">
    Nome Despesa:<br/>
    <input type="text" name="Nome" id="D" />
  </label><br/><br/>

  <label>
    Tipo Despesa:<br/>
    <select name="Tipo">
      <option value="1">Mensal</option>
      <option value="2">Alimentos</option>
      <option value="3">Gastos Avulsos</option>
    </select>
  </label><br/><br/>

  <label for="E">
    Valor Despesa:<br/>
    <input type="number" name="Valor" id="E" max="5000" />
  </label><br/><br/>

  <label for="F">
    Data Despesa:<br/>
    <input type="date" name="Data" id="F"/>
  </label><br/><br/>

  <label>
    Situação Despesa:<br/>
    <select name="Situacao">
      <option value="4">Pago</option>
      <option value="5">Pendente Pagamento</option>
    </select>
  </label><br/><br/>


  <input type="submit" value="Salvar" class="button" />
</form>
