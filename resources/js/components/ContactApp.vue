<template>

<div class="container">

<h1 class="title">Gestion des Contacts</h1>

<div class="form-card">

<h2>Ajouter un contact</h2>

<form @submit.prevent="addContact">

<input v-model="nom" placeholder="Nom" required>

<input v-model="prenom" placeholder="Prénom" required>

<input v-model="contact" placeholder="Contact" required>

<button type="submit">Ajouter</button>

</form>

</div>


<div class="list-card">

<h2>Liste des contacts</h2>

<ul>

<li v-for="c in contacts" :key="c.id">

<span>
{{ c.nom }} {{ c.prenom }} - {{ c.contact }}
</span>

<button class="delete" @click="deleteContact(c.id)">
Supprimer
</button>

</li>

</ul>

</div>

</div>

</template>
<script>
export default {

data(){
return{
nom:'',
prenom:'',
contact:'',
contacts:[]
}
},

mounted(){
this.getContacts()
},

methods:{

async getContacts(){

const res = await fetch('/api/contacts')
const data = await res.json()

this.contacts = data

},

async addContact(){

await fetch('/api/contacts',{
method:'POST',
headers:{
'Content-Type':'application/json',
'Accept':'application/json'
},
body:JSON.stringify({
nom:this.nom,
prenom:this.prenom,
contact:this.contact
})
})

this.getContacts()

this.nom=''
this.prenom=''
this.contact=''

},

async deleteContact(id){

await fetch('/api/contacts/'+id,{
method:'DELETE'
})

this.getContacts()

}

}

}
</script>
<style>

body{
font-family: Arial, Helvetica, sans-serif;
background:#f4f6f8;
}

.container{
width:600px;
margin:40px auto;
}

.title{
text-align:center;
margin-bottom:30px;
}

.form-card{
background:white;
padding:20px;
border-radius:8px;
box-shadow:0 2px 10px rgba(0,0,0,0.1);
margin-bottom:30px;
}

input{
width:100%;
padding:10px;
margin-bottom:10px;
border:1px solid #ccc;
border-radius:5px;
}

button{
background:#3498db;
color:white;
border:none;
padding:10px 15px;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2980b9;
}

.list-card{
background:white;
padding:20px;
border-radius:8px;
box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

li{
display:flex;
justify-content:space-between;
align-items:center;
padding:8px 0;
border-bottom:1px solid #eee;
}

.delete{
background:#e74c3c;
}

.delete:hover{
background:#c0392b;
}

</style>