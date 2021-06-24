import React from "react";
import styles from './Home.module.css'
import DropZone from "./Uppy/Uppy";

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
        <form onSubmit={this.handleSubmit}>
          <label>
            Upload file:
            <input type="file" ref={this.Home} />
          </label>
          <br />
          <button type="submit">Submit</button>
        </form>
        <div>
          <DropZone />
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