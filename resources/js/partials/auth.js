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
                rej('Combinação errada de e-mail / senha.')
            })
    })
}
