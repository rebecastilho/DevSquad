<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Produtos
                        <div class='float-right'>
                            <router-link :to="{ name: 'create' }" class="btn btn-primary">Adicionar Produto</router-link>
                        </div>
                    </div>
                    <div class="card-body">
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
                                        <router-link :to="{name: 'edit', params: { id: produto.id }}" class="btn btn-primary">Editar</router-link>
                                        <router-link :to="{name: 'show', params: { id: produto.id }}" class="btn btn-success">Visualizar</router-link>
                                        <button class="btn btn-danger" @click.prevent="deleteProduto(produto.id)">Deletar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
          produtos: []
        }
    },
    created() {
        let uri = 'http://localhost:8000/api/produtos';
        this.axios.get(uri).then(response => {
            this.produtos = response.data.data;
        });
    },
    methods: {
      deleteProduto(id)
      {
        let uri = `http://localhost:8000/api/produto/delete/${id}`;
        this.axios.delete(uri).then(response => {
          this.produtos.splice(this.produtos.indexOf(id), 1);
        });
      }
    }
  }
</script>
