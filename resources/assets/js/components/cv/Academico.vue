<template>
  <div id="app" class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">Competencias Académicas ({{ items.length }})
            <span v-show="add || edit">
              <button class="btn-small btn-danger" title="Cancelar" style="float: right"><span @click='cancel()' class="glyphicon glyphicon-remove"></span></button>
            </span>
            <span v-show="!add && !edit">
              <button class="btn-small" title="Ver/Ocultar detalle" style="float: right" @click='click_view()'><span :class="class_b2"></span></button>
            </span>
            <button class="btn-small" title="Agregar detalle" style="float: right"><span @click='click_add()' :class="class_b1"></span></button>
          </div>
          <div class="panel-body">
              <span v-show="view && !add && !edit">
                <div class="panel panel-group">              
                  <div v-for="item in items">
                    <div class="panel panel-heading">Grado Académico: {{ item.titulo }}
                      <button @click="remove(item)" class="btn-small btn-danger" title="Eliminar detalle" style="float: right"><span class="glyphicon glyphicon-remove"></span></button>
                      <button @click="editing(item)" class="btn-small btn-warning" title="Editar detalle" style="float: right"><span class="glyphicon glyphicon-pencil"></span></button>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-body">Nivel: {{ item.wnivel }}</div>
                      <div class="panel-body">Documento:
                        <span v-if="item.documento">
                           <a href="#" @click="openPDF(item.documento)" class="btn-small btn-success">Ver archivo: {{ item.name_file }}</a>
                        </span>
                      </div>
                      <div class="panel-body">Desde: {{ item.yini }} 
                        <span v-if="item.yfin">
                          hasta: {{ item.yfin }}
                        </span>
                        <span v-else>
                          hasta: Actualidad
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </span>
              <span v-show="add || edit">
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
                          <option v-for="nivel in niveles" :value="nivel.nivel_id">
                            {{ nivel.wnivel }}
                          </option>
                        </select>
                    </div>
                  </div>
                  <div class="panel panel-default">
                    <span v-show="add">                      
                      <div class="panel-body">
                        Documento: Subir PDF<br> 
                        <div class="col-md-7">
                          <input type="hidden" name="MAX_FILE_SIZE" value="30000">
                          <input id="upload-file" type="file" class="form-control" @change="fieldChange">
                        </div>
                      </div>
                    </span>
                    <span v-show="edit">                      
                      <div class="panel-body">
                        Documento: {{ newItem.name_file }}<br> 
                      </div>
                    </span>
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
      this.toastr_init();
    },
    props: ['user_id'],
    data() {
      return {
        tipo: 'academico',
        items:[],
        view: false,
        add: false,
        // save: false,
        edit: false,
        niveles: [],
        // class_view: 'glyphicon glyphicon-triangle-bottom',
        // class_add: 'glyphicon glyphicon-plus',
        newItem:{
          id: 'new',
          titulo: '',
          nivel_id: '',
          name_file: '',
          documento: '',
          yini: '',
          yfin: '',
          file: [],
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
    computed:{
      class_b1: function () {
        switch(this.add) {
          case true:
            switch(this.edit) {
              case true:
                return 'error';
                break;
              case false:
                return 'glyphicon glyphicon-ok';
                break;
            }
            break;
          case false:
            switch(this.edit) {
              case true:
                return 'glyphicon glyphicon-ok';
                break;
              case false:
                return 'glyphicon glyphicon-plus';
                break;
            };       
            break;
        };
      },
      class_b2: function () {
        if(this.view){
          return 'glyphicon glyphicon-triangle-top';
        }else{
          return 'glyphicon glyphicon-triangle-bottom';
        }
      },
    },
    methods:{
      toastr_init(){
        toastr.closeButton = false;
        toastr.debug = false;
        toastr.showDuration = 100;
      },
      openPDF(documento){
        var archivo = "/storage/"+this.tipo+"/"+documento;
        window.open(archivo);
        return false;
      },
      editing: function (item) {
        this.clear_data();
        this.edit = true;
        this.newItem.id = item.id;
        this.newItem.titulo = item.titulo;
        this.newItem.nivel_id = item.nivel_id;
        this.newItem.name_file = item.name_file;
        this.newItem.documento = item.documento;
        this.newItem.yini = item.yini;
        this.newItem.yfin = item.yfin;
        // this.class_b1();
      },
      clear_data(){
        this.view = false,
        this.add = false,
        this.edit = false,
        
        this.newItem.id = 'new';
        this.newItem.titulo = '';
        this.newItem.nivel_id = '';
        this.newItem.name_file = '';
        this.newItem.documento = '';
        this.newItem.yini = '';
        this.newItem.yfin = '';
        this.form = new FormData;
        this.attachment = '';
      },
      async click_save (){
        if(this.consistencia() == 0){
          if(this.add){
            await this.uploadFile();
          }
          this.save_data();
          return true;
        }
        return false;
      },
      async click_add () {
        if(!this.add && !this.edit){
          this.add = true;
          this.$emit('changeAdd', this.tipo);
        }else{
          var response = await this.click_save();
          if(response){
            toastr.success('Registro grabado.');
          }
        }
      },
      click_view: function () {
        this.view = !this.view;
        if(this.view){
          this.class_view = 'glyphicon glyphicon-triangle-top';
        }else{
          this.class_view = 'glyphicon glyphicon-triangle-bottom';
        }
      },
      fieldChange(e){
// console.log('e.target: ', e.target);
// console.log('e.target.files: ', e.target.files);
        let selectedFiles = e.target.files;
        if(!selectedFiles.length){
          this.attachment = '';
          this.newItem.name_file = '';
          return false;
        }
        if(selectedFiles[0].type != 'application/pdf'){
          toastr.error('Sólo se permiten archivos PDF.');
          this.attachment = '';
          this.newItem.name_file = '';
          return false;
        }
        this.attachment = selectedFiles[0];
        this.newItem.name_file = selectedFiles[0].name;
      },
      async uploadFile() {
        this.form.append('doc',this.attachment);
        this.form.append('tipo',this.tipo);
        const config = { headers: { 'Content-Type': 'multipart/form-data' } };
        document.getElementById('upload-file').value=[];
        await axios.post('/api/cv/'+this.tipo+'/upload',this.form,config).then(response=>{
          let str = response.data.path;
          let n = str.indexOf(this.tipo+'/') + this.tipo.length;
          this.newItem.documento = str.substring(n+1);
// console.log('uploadFile: ', this.newItem.documento);
        }).catch(response=>{
          console.log(this.tipo+' uploadFile Error');
        });
      },
      remove: function (item) {
        let request = {
                    'data': item,
                  };
        var url = this.protocol+'//'+this.URLdomain+'/api/cv/academico/destroy';
        axios.post(url, request).then(response=>{
          toastr.success('Registro eliminado: '+item.titulo);
// console.log('remove: ', response.data);
          this.getData();
        }).catch(response=>{
          console.log(this.tipo+' remove Error');
        });
      },
      cancel: function () {
        this.add = !this.add;
        this.edit = false;
        this.class_add = 'glyphicon glyphicon-plus';
        this.clear_data();
        this.$emit('clearView');
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
      async save_data() {
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
        await axios.post(url, request).then(response=>{
          // console.log(this.tipo+' save_data response.data: ',response.data);
          this.$emit('clearView');
          this.clear_data();
          this.getData();
        }).catch(function (error) {
            console.log(this.tipo+' save_data: ',error);
        });
      },
      sort_yini: function () {
        this.items.sort(function (a, b) {
          return (b.yini - a.yini);
        });
      },
      consistencia(){
        var consistencia = [];
        if(!this.newItem.titulo){
          consistencia.push("Debe ingresar el Grado Académico conseguido.");
        }
        if(!this.newItem.nivel_id){
          consistencia.push("Debe seleccionar el Grado conseguido en el campo Nivel.");
        }
        if(!this.newItem.name_file && this.add){
          consistencia.push("Debe subir el Documento que certifique el grado conseguido en formato PDF.");
        }
        if(!this.newItem.yini){
          consistencia.push("Debe ingresar el año de inicio de sus estudios.");
        }
        if(this.newItem.yfin.length == 0){
          consistencia.push("Debe ingresar el año de fin de sus estudios o cero si se encuentra en curso.");
        }
        for (var i = consistencia.length - 1; i >= 0; i--) {
          toastr.error(consistencia[i]);
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
