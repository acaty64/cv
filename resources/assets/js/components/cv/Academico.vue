<template>
  <div id="app" class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Competencias Académicas
            <span v-show="add">
              <button class="btn-small btn-danger" title="Cancelar" style="float: right"><span @click='cancel()' class="glyphicon glyphicon-remove"></span></button>
            </span>
            <span v-show="!add">
              <button class="btn-small" title="Ver/Ocultar detalle" style="float: right" @click='click_view()'><span :class="class_view"></span></button>
            </span>
            <button class="btn-small" title="Agregar detalle" style="float: right"><span @click='click_add()' :class="class_add"></span></button>
          </div>
          <div class="panel-body">
              <span v-show="view && !add">
                <div class="panel panel-group">              
                  <div v-for="item in items">
                    <div class="panel panel-heading">Titulo: {{ item.titulo }}
                      <button @click="remove(item)" class="btn-small btn-danger" title="Eliminar detalle" style="float: right"><span class="glyphicon glyphicon-remove"></span></button>
                      <button @click="editing(item)" class="btn-small btn-warning" title="Editar detalle" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-body">Nivel: {{ item.wnivel }}</div>
                      <div class="panel-body">Documento: 
                        <!-- {{ item.documento }} -->
                        <span v-if="item.documento">
                          Ver PDF <button class="btn-small btn-success"><span class="glyphicon glyphicon-eye-open"></span></button>
                        </span>
                      </div>
                      <div class="panel-body">Desde: {{ item.yini }} hasta: {{ item.yfin }}</div>
                    </div>
                  </div>
                </div>
              </span>
              <span v-show="add">
                <div class="panel panel-group">              
                  <div class="panel panel-default">
                    <div class="panel-body">
                      Titulo:
                      <input type="text" v-model="newItem.titulo" maxlength="100" class="form-control">
                    </div> 
                  </div> 
                  <div class="panel panel-default">
                    <div class="panel-body">Nivel: {{ newItem.nivel_id }}
                        <select dusk="sel_nivel" id="sel_nivel" v-model="newItem.nivel_id" class="form-control">
                           <!-- v-on:change="registerNivel(newItem)" -->
                          <option v-for="nivel in niveles" :value="nivel.nivel_id">
                            {{ nivel.wnivel }}
                          </option>
                        </select>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      Documento: Subir PDF<br> 
                      <div class="col-md-7">
                        <input id="upload-file" type="file" class="form-control" @change="fieldChange">
                      </div>
<!--                       <div class="col-md-1">
                        <button @click="uploadFile" class="btn-small btn-success" style="float: center"><span class="glyphicon glyphicon-upload"></span></button>
                      </div> -->
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <span class="col-md-2">
                        Desde: <input type="text" v-model="newItem.yini" maxlength="4" class="form-control">
                      </span>
                      <span class="col-md-2">
                       hasta: <input type="text" v-model="newItem.yfin" maxlength="4" class="form-control">
                      </span>
                    </div>
                  </div>
                </div>
              </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
      console.log('Academico mounted.');
      this.getData();
    },
    props: ['user_id'],
    data() {
      return {
        tipo: 'academico',
        items:[],
        view: true,
        add: false,
        save: false,
        edit: false,
        niveles: [],
        class_view: 'glyphicon glyphicon-triangle-top',
        class_add: 'glyphicon glyphicon-plus',
        newItem:{
          id: 'new',
          titulo: '',
          nivel_id: '',
          name_file: '',
          documento: '',
          yini: '',
          yfin: '',
        },
        editItem:{
          id: '',
          titulo: '',
          nivel_id: '',
          name_file: '',
          documento: '',
          yini: '',
          yfin: '',
        },
        URLdomain: window.location.host,
        protocol: window.location.protocol,
        years: [],
        // Inicio data default uploadFile
        attachment:'',
        form: new FormData,
        // Fin data default uploadFile
      };
    },
    methods:{
      fieldChange(e){
        let selectedFiles = e.target.files;
        if(!selectedFiles.length){
          this.attachment = '';
          this.newItem.name_file = '';
          return false;
        }
        this.attachment = selectedFiles[0];
        this.newItem.name_file = selectedFiles[0].name;
      },
      // generador: function*() {
      //   this.uploadFile();
      //   this.save_data();
      // },
      uploadFile() {
        this.form.append('doc',this.attachment);
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };
        document.getElementById('upload-file').value=[];
        axios.post('/upload',this.form,config).then(response=>{
          let str = response.data.path;
          let n = str.indexOf('/');
          this.newItem.documento = str.substring(n+1);
        }).catch(response=>{
          console.log(this.tipo+' uploadFile Error');
        });
      },
      editing: function (item) {
        alert("EN CONSTRUCCION Editar item: "+item.id);
      },
      remove: function (item) {
        alert("EN CONSTRUCCION Eliminar item: "+item.id);
      },
      cancel: function () {
        alert("EN CONSTRUCCION Cancelar Agregar");
      },
      getData: function () {        
        var url = this.protocol+'//'+this.URLdomain+'/api/cv/academico/load/'+this.user_id;
        axios.get(url).then(response=>{
            this.items = response.data.datos;
            this.sort_yini();
            this.niveles = response.data.niveles;
        }).catch(function (error) {
            console.log(this.tipo+' getData: ',error);
        });
      },
      click_view: function () {
        this.view = !this.view;
        if(this.view){
          this.class_view = 'glyphicon glyphicon-triangle-top';
        }else{
          this.class_view = 'glyphicon glyphicon-triangle-bottom';
        }
      },
      click_add: function () {
        if(!this.add){
          this.add = !this.add;
          this.class_add = 'glyphicon glyphicon-ok';
          this.$emit('changeAdd', this.tipo);
        }else{
          this.click_save();
          this.add = !this.add;
          this.class_add = 'glyphicon glyphicon-plus';
        }
      },
      save_data() {
        var request = {
            'user_id': this.user_id,
            'id': this.newItem.id,
            'titulo': this.newItem.titulo,
            'nivel_id': this.newItem.nivel_id,
            'name_file' : this.newItem.name_file,
            'documento': this.newItem.documento,
            'yini': this.newItem.yini,
            'yfin': this.newItem.yfin,
        };
        var url = this.protocol+'//'+this.URLdomain+'/api/cv/academico/save';
        axios.post(url, request).then(response=>{
          console.log(this.tipo+' save_data response.data: ',response.data);
          this.getData();
          this.$emit('clearView');
        }).catch(function (error) {
            console.log(this.tipo+' save_data: ',error);
        });
      },
      click_save: async function(){
        if(this.consistencia() > 0){
          console.log(this.tipo+' consistencia error.');
          return false;
        }
        var promesa = await this.uploadFile();
        this.save_data();
        alert('Registro grabado.');
      },
      sort_yini: function () {
        this.items.sort(function (a, b) {
          return (b.yini - a.yini);
        });
      },
      consistencia(){
        var consistencia = [];
        if(!this.newItem.titulo){
          consistencia.push("Debe ingresar el Título conseguido.");
        }
        if(!this.newItem.nivel_id){
          consistencia.push("Debe seleccionar el Grado conseguido en el campo Nivel.");
        }
        if(!this.newItem.name_file){
          consistencia.push("Debe subir el Documento que certifique el grado conseguido en formato PDF.");
        }
        if(!this.newItem.yini){
          consistencia.push("Debe ingresar el año de inicio de sus estudios.");
        }
        if(!this.newItem.yfin){
          consistencia.push("Debe ingresar el año de fin de sus estudios o cero si se encuentra en curso.");
        }
        for (var i = 0; i<consistencia.length; i++) {
          alert(consistencia[i]);
        }
        return consistencia.length;
      },
    },
  }
</script>

<style> 
  .panel-heading {
    font-weight: bold;
  }

</style>
