export function registerUser(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/register', credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Ocorreu um erro .. tente novamente mais tarde.')
            })
    })
}

export function login(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/login', credentials)
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Combinação errada de e-mail / senha.')
            })
    })
}

export function getUser(token){
    return new Promise((res,rej)=>{
        axios.get('/api/auth/user', {headers: { Authorization: `Bearer ${JSON.parse(token).token}` }})
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Erro so buscar o usuário logado.')
            })
    })
}

export function editUser(token, form, userId) {
    return new Promise((res,rej)=>{
        axios.post('/api/auth/user/edit/' + userId, {
            name: form.name,
            email: form.email,
            role: form.role
        }, {headers: { Authorization: `Bearer ${JSON.parse(token).token}` }})
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Erro ao editar o usuário.')
            })
    })
}

export function logs(token){
    return new Promise((res,rej)=>{
        axios.get('/api/auth/user/logs', {headers: { Authorization: `Bearer ${JSON.parse(token).token}` }})
            .then(response => {
                res(response.data);
            })
            .catch(err => {
                rej('Erro os logs dos usuários.')
            })
    })
}
