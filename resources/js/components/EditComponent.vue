<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Atualizar Produto</div>
          <div class="card-body">
            <form @submit.prevent="updateProduto">
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
                    <ValidationProvider rules="required|max:64" v-slot="{ errors }">
                      <label>Nome:</label>
                      <input type="text" class="form-control" v-model="produto.nome" />
                      <span class="alert-danger">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <ValidationProvider rules="required" v-slot="{ errors }">
                      <label>Descrição:</label>
                      <textarea class="form-control" v-model="produto.descricao" rows="5"></textarea>
                      <span class="alert-danger">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <label>Categoria:</label>
                    <ValidationProvider rules="required" v-slot="{ errors }">
                      <select v-model="produto.categoria_id" class="form-control">
                        <option disabled class="selected">Escolha uma Categoria....</option>
                        <option
                          :value="categoria.id"
                          v-for="categoria in categorias"
                          :key="categoria.id"
                        >{{categoria.nome}}</option>
                      </select>
                      <span class="alert-danger">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8 offset-md-2">
                  <div class="form-group">
                    <ValidationProvider rules="required" v-slot="{ errors }">
                      <label>Preco:</label>
                      <input
                        type="number"
                        step="0.01"
                        min="0"
                        class="form-control"
                        v-model="produto.preco"
                      />
                      <span class="alert-danger">{{ errors[0] }}</span>
                    </ValidationProvider>
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
<!-- jsdelivr cdn -->
<script src="https://cdn.jsdelivr.net/npm/vee-validate@latest/dist/vee-validate.js"></script>

<!-- unpkg -->
<script src="https://unpkg.com/vee-validate@latest"></script>

<script>
import { extend } from "vee-validate";
import { required, max } from "vee-validate/dist/rules";

extend("required", required);
extend("max", max);

extend("required", {
  message: "Preencha o campo!"
});
extend("max", {
  message: "Nome deve ser menor que 64 caracteres!"
});
export default {
  data() {
    return {
      produto: {},
      categorias: {},
      categoriaAtual: {},
      urlImage: "http://loja.muchiutt.com.br/images/sem-imagem-veiculo.png"
    };
  },
  created() {
    let uri = `http://localhost:8000/api/produto/show/${this.$route.params.id}`;
    this.axios.get(uri).then(response => {
      this.produto = response.data.produto;
      this.categorias = response.data.categorias;
      this.categoriaAtual = response.data.categoria_atual;
      this.urlImage =  response.data.url + this.produto.imagem.replace("public","storage");
    });
    
  },
  methods: {
    updateProduto() {
      let uri = `http://localhost:8000/api/produto/update/${this.$route.params.id}`;
      this.axios.post(uri, this.produto).then(response => {
        this.$router.push({ name: "produtos" });
      });
    },
    onImageChange(e) {
      this.produto.imagem = e.target.files[0];
      this.urlImage = URL.createObjectURL(this.produto.imagem);
    }
  }
};
</script>