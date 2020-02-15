using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerMovement : MonoBehaviour
{

    public Rigidbody rd;
    public float forwardForce = 2000f;
    public float sidewaysForce = 500f;


    // Start is called before the first frame update
    void Start()
    {
        //test
        //rd.useGravity = false;
        //rd.AddForce(0, 200, 500);
    }

    // Update is called once per frame
    void FixedUpdate()
    {
        rd.AddForce(0, 0, forwardForce * Time.deltaTime);

        if (Input.GetKey("d"))
        {
            rd.AddForce(sidewaysForce * Time.deltaTime, 0, 0, ForceMode.VelocityChange);
        }
        if (Input.GetKey("a"))
        {
            rd.AddForce(-sidewaysForce * Time.deltaTime, 0, 0, ForceMode.VelocityChange);
        }

        if(rd.position.y < -1f)
        {
            FindObjectOfType<GameManager>().GameOver();
        }

    }
}
