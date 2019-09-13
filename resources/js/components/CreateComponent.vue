<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Adicionar Produto</div>
          <div class="card-body">
            <form enctype="multipart/form-data" @submit.prevent="addProduto">
              <div class="row">
                <div class="col-md-8 offset-md-4">
                  <div class="form-group">
                    <div class="divImage">
                      <input
                        name="file"
                        id="foto"
                        hidden
                        type="file"
                        class="custom-file-input form-control"
                        accept="image/jpeg, image/png"
                        lang="pt-br"
                        @change="onImageChange"
                      />
                      <img
                        width="120vw"
                        :src="urlImage"
                        id="imagemProduto"
                        class="rounded-circle border border-dark"
                      />
                      <p class="comentario">Enviar Foto</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" class="form-control" v-model="produto.nome" />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Descrição:</label>
                    <textarea class="form-control" v-model="produto.descricao" rows="5"></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Categoria:</label>
                    <select v-model="produto.categoria_id" class="form-control">
                      <option value disabled class="selected">Escolha uma Categoria....</option>
                      <option
                        :value="categoria.id"
                        v-for="categoria in categorias"
                        :key="categoria.id"
                      >{{categoria.nome}}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Preco:</label>
                    <input type="text" class="form-control" v-model="produto.preco" />
                  </div>
                </div>
              </div>

              <div class="form-group">
                <button class="float-right btn btn-primary">Adicionar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      produto: {},
      categorias: [],
      urlImage  : "http://loja.muchiutt.com.br/images/sem-imagem-veiculo.png"
    };
  },
  created() {
   this.produto.imagem = this.urlImage;
   let uri = `http://localhost:8000/api/produto/categorias`;
    this.axios.get(uri).then(response => {
      this.categorias = response.data;
    });
  },
  methods: {
    addProduto() {
      
      let data = new FormData();
      data.append("imagem", this.produto.imagem);
      data.append('nome', this.produto.nome);
      data.append('descricao', this.produto.descricao);
      data.append('categoria_id', this.produto.categoria_id);
      data.append('preco', this.produto.preco);
    console.log(data.get('imagem'));
      let uri = "http://localhost:8000/api/produto/create";

      this.axios.post(uri,data,  {headers: {'Content-Type': 'multipart/form-data'}}).then(response => {
        console.log(response);
      });
    },
    onImageChange(e) {
      this.produto.imagem = e.target.files[0];
      this.urlImage = URL.createObjectURL(this.produto.imagem);
      
    }
  }
};
</script>