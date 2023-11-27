public void Obetner(javax.swing.JTable tabla,javax.swing.JComboBox<String> Combo,javax.swing.JTextPane total2,String cedula){
        DefaultTableModel modelo ;
        modelo=(DefaultTableModel)tabla.getModel();
        modelo.setRowCount(0);
        try{
            modelo.setColumnIdentifiers(new Object[]{"Id","Tipo","Monto","Cuenta"});
//            Combo.removeAllItems();
//            Combo.addItem(" ");
//            Combo.addItem("deposito");
//            Combo.addItem("retiro");
            HttpClient cliente = HttpClientBuilder.create().build();
            HttpGet get = new HttpGet("http://localhost/pruebacuenta/api.php?cedula="+cedula);
            HttpResponse respuesta=cliente.execute(get);
            String info = EntityUtils.toString(respuesta.getEntity());
            JSONArray array = new JSONArray(info);
            int total=0;
            int dep=0;
            int ret=0;
          
            for (int i = 0; i <array.length(); i++) {
                JSONObject objeto = array.getJSONObject(i);
                
                String selecion=Combo.getSelectedItem().toString();
                String selec2=objeto.getString("tipo");
                System.out.println(selecion);
                System.out.println("Seleccion 2 :"+selec2);
                if( selec2.equals(selecion.toLowerCase())){
                String transa = String.valueOf(objeto.getInt("id_tran"));
                String tipo = objeto.getString("tipo");
                String monto = String.valueOf(objeto.getInt("monto"));
                String cuenta = objeto.getString("cuenta");    
                 modelo.addRow(new Object[]{transa,tipo,monto,cuenta});
                   if(tipo.equals("deposito")){
                       total=0;
                    dep+=objeto.getInt("monto");
                }else  if(tipo.equals("retiro")){
                    total=0;
                    ret+=objeto.getInt("monto");
                }
                }else if(selecion.equals(" ")){
                    String transa = String.valueOf(objeto.getInt("id_tran"));
                String tipo = objeto.getString("tipo");
                String monto = String.valueOf(objeto.getInt("monto"));
                String cuenta = objeto.getString("cuenta");
                 modelo.addRow(new Object[]{transa,tipo,monto,cuenta});
              
                  String tipo1 = objeto.getString("tipo");
                if(tipo1.equals("deposito")){
                    dep+=objeto.getInt("monto");
                }else  if(tipo1.equals("retiro")){
                    ret+=objeto.getInt("monto");
                }
                }
              
                
               
            }
              total=dep-ret;
            total2.setText(String.valueOf(total));
        }catch(Exception e){
            System.out.println("Error" +e);
        }
    }