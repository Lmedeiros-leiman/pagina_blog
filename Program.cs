// See https://aka.ms/new-console-template for more information

using System;

// https://youtu.be/_S87vHUobvQ?si=N4wHEkwaVV0EnjsT&t=1128
//  18:50
// Objetivo:
// Emular por completo os carrinhos do factorio
// Problema: 
// preciso emular todos os componentes do 0.
//  - criar a classe carrinho
//      - cada carrinho tera seu ID
//      - cada carrinho tera seu objetivo
//      - cada carrinho tera seu inventario (desafio: no máximo 4 elementos)
//
//
// INVENTARIO:
// podemos imaginar uma lista onde:
// 0 - ferro
// 1 - cobre
// 2 - fios (de cobre)
// 3 - engrenagem
//

class Conteudo 
{
    public static List<int[]> Inventario = new();





}

class Carrinho : Conteudo
{
    // aproveitando que estou simulando, o inventario do jogo poderia funcionar com esse sistema ID,quantidade
    // bastaria apenas criar um dicionario para evitar confusoes
    // id = 0 = MINÉRIO_FERRO
    // se quiser complicar poderia transformar o id em um ponteiro para um objeto Item
    // mas no final quando a lógica chegasse na renderização de sprites dos items não faria muita diferença... eu acho...
    // e no caso do cursor este poderia ser um objeto com seu próprio inventario.
    // a diferença seria que teria espaço pra um item e este item seria mostrado no mouse do jogador.
    //private List<int[]> Inventario = new();
    public List<int[]> PegaInventario()
    {
        return Inventario;
    }
    public int ContagemItens(){
        return Inventario.Count();        
    }
    private int CapacidadeInventario = -1; // negativo para infinito.
    private int ChecarCapacidade(int quantidadeItens = 1) // retorna int de quantos items cabem.
    {
        if (CapacidadeInventario < 0) { return quantidadeItens; }

        return CapacidadeInventario - ( quantidadeItens + Inventario.Count() );
    }

    public bool Carregar(int ID, int quantidade = 1) 
    {   
        // só adicionar o item no carrinho :)
        int[] Item = {ID, quantidade};
        Inventario.EnsureCapacity(Inventario.Count + 1);

        if ( Convert.ToBoolean(ChecarCapacidade()) ) { return false; }

        Inventario.Add(Item);
        return true;
    }
    public bool Carregar(int[] item) 
    {
        if ( Convert.ToBoolean(ChecarCapacidade()) ) { return false; }

        return true;
    }
    public int[] Descarregar(int Selecao) // retira um iten especifico do carrinho e o retorna.
    {   
        
        int[] Aux = Inventario[Selecao];
        Inventario.RemoveAt(Selecao);
        return Aux;
        
    }
    public void LimparInventario()
    {
        Inventario.Clear();
    }

}

class Minerador
{
    private readonly static int QuantidadeMinerada = 1;

    public static int[] Minerar(int Minério)
    {
        return Minerar(Minério, QuantidadeMinerada);
    }
    public static int[] Minerar(int Minério, int quantidade)
    {
        // se isso fosse um jogo, teriamos um loop de jogo
        // o loop de jogo poderia chamar esta função para cada minerador no caso do factorio
        // que iria incrementar um "work progress"
        // e caso o work progress tivesse completo era só colocar o item no mundo OU no inventario
        // mas como não existe esse relógio eu gero tudo no tempo que gera pro processador processar 😎
        int[] Item = {Minério,quantidade};
        return Item;
    }
}
class Fabricador
{
    // uma classe que pega itens e retorna um componente :)
    // se isso fosse factorio o fabricador seria um objeto não estatico. mesmo pro minerador.
    // isso permitiria criar um segundo dicionário para receitas
    // onde o valor seria um Item com seu ID e quantidade.
    // ou então um array de Items...
    // dai era só questão de fazer um cheque a cada update do relógio global
    // tem os itens da receita? começa ela.
    // esta trabalhando? incrementa e checa se esta pronto
    // esta pronto? solta o item no inventario ou saida e checa se tem itens da receita.
    //
    //

    private List<int[]> Inventario = new();

    public static int[] Engrenagem(Carrinho carrinho) // retorna os itens craftados.
    {   
        // como arrays funcionam com ponteiros, posso subtrair do ponteiro e isso vai modificar o array.
        // o problema é: como posso remover o ponteiro do array do inventario do carrinho caso a quantidade seja 0?
        int IDengrenagem = 3;
        int EngrenagensProduzidas = 0;


        // receita = 2x ferro pra 1 engrenagem
        List<int[]> Inventario = carrinho.PegaInventario(); 

        for (int i = 0; i < Inventario.Count(); i++ ) 
        { //0 = ID | 1 = quantidade
            int[] itemAtual = Inventario[i];

            if (itemAtual[0] != 0 ) 
            {
                break;
            }

        }


        int[] ItemEngrenagem = {IDengrenagem, EngrenagensProduzidas};
        return ItemEngrenagem;
        
    }
    public static int[] Fio()
    {
        int[] ItemResultado = {1,2};
        return ItemResultado;
    }

}

class Cerebro
{
    //
    
}



