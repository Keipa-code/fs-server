import api from '../Api/Api'

function GetRowCount(searchValue = null) {
  api
    .post('/api/count', {
      search: searchValue,
    })
    .then((data) => {
      return data.count
    })
  return 1
}

export default GetRowCount
