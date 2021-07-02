import React, {useContext} from 'react';
import {Context} from "../index";
import {Row} from "react-bootstrap";
import FileItem from "./FileItem";
import {observer} from "mobx-react-lite";

const FilesList = observer(() => {
  const file = useContext(Context)

  return (
   <Row className="d-flex">
     {file.files.map(file =>
      <FileItem key={file.id} file={file}/>
        )}
   </Row>
  )
});

export default FilesList