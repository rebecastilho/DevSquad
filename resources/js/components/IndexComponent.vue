<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Produtos
            <div class="float-right">
              <router-link :to="{ name: 'create' }" class="btn btn-primary">Adicionar Produto</router-link>
            </div>
          </div>
          <div class="card-body">
            <div class="row justify-content-center">
              <form @submit.prevent="pesquisar" class="form-inline my-2 my-lg-0">
                <input
                  v-model="pesquisa.nome"
                  class="form-control mr-sm-2"
                  type="search"
                  placeholder="Pesquisar"
                  aria-label="Pesquisar"
                />
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
              </form>
            </div>
            <hr />
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Preco</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="produto in produtos" :key="produto.id">
                  <td>{{ produto.nome }}</td>
                  <td>{{ produto.preco }}</td>
                  <td>{{ produto.categoria_id }}</td>
                  <td>
                    <router-link
                      :to="{name: 'edit', params: { id: produto.id }}"
                      class="btn btn-primary"
                    >Editar</router-link>
                    <router-link
                      :to="{name: 'show', params: { id: produto.id }}"
                      class="btn btn-success"
                    >Visualizar</router-link>
                    <button
                      class="btn btn-danger"
                      @click.prevent="deleteProduto(produto.id)"
                    >Deletar</button>
                  </td>
                </tr>
              </tbody>
            </table>
            <nav aria-label="Paginas">
              <ul class="pagination justify-content-center">
                <li
                  class="page-item"
                  v-for="page in pages"
                  :key="page"
                  :class="{active: source.current_page == page}"
                >
                  <a class="page-link" v-on:click="navegar(page)">{{page}}</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { range } from "lodash";

export default {
  data() {
    return {
      produtos: [],
      pages: [],
      source: [],
      pesquisa: {}
    };
  },
  created() {
    let uri = `http://localhost:8000/api/produtos?page=1`;
    this.axios.get(uri).then(response => {
      this.produtos = response.data.data;
      this.source = response.data.meta;
      this.pages = range(1, this.source.last_page + 1);
    });
  },
  methods: {
    navegar(page) {
      let uri = `http://localhost:8000/api/produtos?page=${page}`;
      this.axios.get(uri).then(response => {
        this.produtos = response.data.data;
      });
      this.source.current_page = page;
    },
    pesquisar() {
      console.log(this.pesquisa.nome);
      let uri = `http://localhost:8000/api/produto/pesquisa/${this.pesquisa.nome}`;
      this.axios.get(uri).then(response => {
        this.produtos = response.data.data;
        this.source = response.data.meta;
        this.pages = range(1, this.source.last_page + 1);
      });
    },
    deleteProduto(id) {
      let uri = `http://localhost:8000/api/produto/delete/${id}`;
      this.axios.delete(uri).then(response => {
        this.produtos.splice(this.produtos.indexOf(id), 1);
      });
    }
  }
};
</script>
