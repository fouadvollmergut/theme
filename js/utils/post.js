const post = (endpoint, data) => {
  return fetch(
    window.location.origin + endpoint, 
    {
      'method': 'POST', 
      'body': data,
      'redirect': 'follow'
    }
  );
}

export default post;