import React from "react";
import styles from './Home.module.css'
import Dropzone from './Uppy/Dropzone'

class Home extends React.Component {
  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.Home = React.createRef();
  }
  handleSubmit(event) {
    event.preventDefault();
    fetch('/api/upload', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: this.Home.current.files['0']
    }).then((response) => {})
      .then((success => console.log(success)))
      .catch((error) => {})
  }
  render() {
    return (
      <div className={styles.Home}>
        <h1>FS-Server</h1>
        <p>Мы скоро откроемся</p>
        <div>
          <Dropzone />
        </div>
      </div>
    )
  }
  }

  /*
const handleSubmit = (event) => {
  event.preventDefault()

  fetch('/api/upload', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
  }).then(r => {})
}*/
/*

function Home() {

}
*/

export default Home